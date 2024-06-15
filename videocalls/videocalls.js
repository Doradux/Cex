const APP_ID = "441c01c71df64650b291b06579fdc57c";

let client;
let localTracks = {
  videoTrack: null,
  audioTrack: null,
};
let screenTrack = null;
let remoteUsers = {};
let isCameraHidden = false;
let isMicMuted = false;
let isScreenShared = false;

const init = async () => {
  client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });
  await client.join(APP_ID, chanelId, null, null);

  try {
    [localTracks.audioTrack, localTracks.videoTrack] =
      await AgoraRTC.createMicrophoneAndCameraTracks({
        audio: {
          ANS: false, // Automatic Noise Suppression
          AEC: false, // Acoustic Echo Cancellation
          AGC: false, // Automatic Gain Control
        },
        video: {},
      });

    // Ensure audio track is enabled
    await localTracks.audioTrack.setEnabled(true);

    let localPlayer = document.getElementById("user-1");
    localTracks.videoTrack.play(localPlayer);

    await client.publish(Object.values(localTracks));
  } catch (err) {
    console.error("Failed to create media tracks", err);
    // Create a placeholder video element if media tracks are not available
    const localPlayer = document.getElementById("user-1");
    localPlayer.style.backgroundColor = "darkcyan";
    localPlayer.style.display = "block";
  }

  client.on("user-published", handleUserPublished);
  client.on("user-unpublished", handleUserUnpublished);
  client.on("user-joined", handleUserJoined);
  client.on("user-left", handleUserLeft);

  monitorVolume();

  // Retrieve existing remote users and subscribe to their streams
  const users = await client.remoteUsers;
  users.forEach(async (user) => {
    console.log(user.uid);
    remoteUsers[user.uid] = user;
    await subscribeToUser(user);

    addUserPlaceholder(user.uid);

    if (user.videoTrack) {
      user.videoTrack.play(document.getElementById(`user-${user.uid}`));
    }
  });

  // Add event listeners for the toggle buttons
  document.getElementById("toggle-cam").addEventListener("click", toggleCamera);
  document.getElementById("toggle-mic").addEventListener("click", toggleMic);
  document
    .getElementById("share-screen")
    .addEventListener("click", toggleScreenShare);

  // Add click event listener to local video element
  document.getElementById("user-1").addEventListener("click", toggleFullscreen);
};

const handleUserJoined = async (user) => {
  remoteUsers[user.uid] = user;
  addUserPlaceholder(user.uid);
  await subscribeToUser(user);
};

const handleUserLeft = (user) => {
  delete remoteUsers[user.uid];
  const remotePlayer = document.getElementById(`user-${user.uid}`);
  if (remotePlayer) {
    remotePlayer.remove();
  }
  removeUserFromList(user.uid);
};

const handleUserPublished = async (user, mediaType) => {
  remoteUsers[user.uid] = user;
  await client.subscribe(user, mediaType);

  const remotePlayer = document.getElementById(`user-${user.uid}`);
  if (!remotePlayer) {
    addUserPlaceholder(user.uid);
  }
  if (mediaType === "video") {
    user.videoTrack.play(document.getElementById(`user-${user.uid}`));
  }

  if (mediaType === "audio") {
    user.audioTrack.play();
  }
};

const handleUserUnpublished = async (user, mediaType) => {
  if (mediaType === "video") {
    const remotePlayer = document.getElementById(`user-${user.uid}`);
    if (remotePlayer) {
      // remotePlayer.style.display = "none";
    }
  }

  if (mediaType === "audio") {
    if (user.audioTrack) {
      user.audioTrack.stop();
    }
  }
};

const toggleCamera = async () => {
  const localPlayer = document.getElementById("user-1");
  if (isCameraHidden) {
    await localTracks.videoTrack.setEnabled(true);
    document.getElementById("toggle-cam").querySelector("img").src =
      "../assets/icons/camera-on.png";
    localPlayer.style.opacity = 1;
    isCameraHidden = false;
  } else {
    await localTracks.videoTrack.setEnabled(false);
    document.getElementById("toggle-cam").querySelector("img").src =
      "../assets/icons/camera-off.png";
    localPlayer.style.opacity = 0;
    isCameraHidden = true;
  }
};

const toggleMic = async () => {
  if (isMicMuted) {
    await localTracks.audioTrack.setEnabled(true);
    document.getElementById("toggle-mic").querySelector("img").src =
      "../assets/icons/mic-on.png";
    isMicMuted = false;
  } else {
    await localTracks.audioTrack.setEnabled(false);
    document.getElementById("toggle-mic").querySelector("img").src =
      "../assets/icons/mic-off.png";
    isMicMuted = true;
  }
};

const toggleScreenShare = async () => {
  if (isScreenShared) {
    await stopScreenShare();
  } else {
    await startScreenShare();
  }
};

const startScreenShare = async () => {
  try {
    screenTrack = await AgoraRTC.createScreenVideoTrack();
    await client.unpublish(localTracks.videoTrack);
    await client.publish(screenTrack);

    screenTrack.on("track-ended", async () => {
      await stopScreenShare();
    });

    const localPlayer = document.getElementById("user-1");
    screenTrack.play(localPlayer);
    document.getElementById("share-screen").querySelector("img").src =
      "../assets/icons/screen-share-off.png";
    isScreenShared = true;
  } catch (err) {
    console.error("Failed to start screen sharing", err);
  }
};

const stopScreenShare = async () => {
  if (screenTrack) {
    await client.unpublish(screenTrack);
    screenTrack.close();
    screenTrack = null;
  }

  if (localTracks.videoTrack) {
    try {
      await client.publish(localTracks.videoTrack);
      const localPlayer = document.getElementById("user-1");
      localTracks.videoTrack.play(localPlayer);
    } catch (err) {
      console.error("Failed to publish video track", err);
      // Create a placeholder video element if media tracks are not available
      const localPlayer = document.getElementById("user-1");
      localPlayer.style.backgroundColor = "darkcyan";
      localPlayer.style.display = "block";
    }
    document.getElementById("share-screen").querySelector("img").src =
      "../assets/icons/screen-share.png";
    isScreenShared = false;

    // Ensure the camera is re-enabled if it was hidden
    if (isCameraHidden) {
      await localTracks.videoTrack.setEnabled(true);
      document.getElementById("toggle-cam").querySelector("img").src =
        "../assets/icons/camera-on.png";
      localPlayer.style.opacity = 1;
      isCameraHidden = false;
    }
  }
};

const addUserPlaceholder = (uid) => {
  const existingPlayer = document.getElementById(`user-${uid}`);
  if (!existingPlayer) {
    const newRemotePlayer = document.createElement("video");
    newRemotePlayer.id = `user-${uid}`;
    newRemotePlayer.autoplay = true;
    newRemotePlayer.style.backgroundColor = "darkcyan";
    newRemotePlayer.playsinline = true;
    document.getElementById("streams-containers").appendChild(newRemotePlayer);

    // Add click event listener to toggle fullscreen
    newRemotePlayer.addEventListener("click", toggleFullscreen);
  }
};

const subscribeToUser = async (user) => {
  if (user.hasVideo) {
    await client.subscribe(user, "video");
  }
  if (user.hasAudio) {
    await client.subscribe(user, "audio");
  }
};

const monitorVolume = () => {
  client.enableAudioVolumeIndicator();
  client.on("volume-indicator", (volumes) => {
    volumes.forEach((volume) => {
      const { uid, level } = volume;
      const speakingThreshold = 1;

      const userElement = document.getElementById(`user-${uid}`);
      if (userElement) {
        if (level > speakingThreshold) {
          userElement.style.outline = "5px solid cyan";
        } else {
          userElement.style.outline = "none";
        }
      }
    });
  });
};

const removeUserFromList = (uid) => {
  const userElement = document.getElementById(`user-info-${uid}`);
  if (userElement) {
    userElement.remove();
  }
};

// Function to toggle fullscreen on video elements
const toggleFullscreen = (event) => {
  const videoElement = event.currentTarget;
  if (videoElement.classList.contains("fullscreen")) {
    videoElement.classList.remove("fullscreen");
  } else {
    // Remove fullscreen from any other video elements
    document.querySelectorAll(".fullscreen").forEach((el) => {
      el.classList.remove("fullscreen");
    });
    videoElement.classList.add("fullscreen");
  }
};

init();
