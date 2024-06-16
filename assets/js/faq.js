const phrases = document.querySelectorAll("p");
const second = document.querySelector(".answers");

var newContent = [
  "Cex is a platform that allows you to make video calls and send real-time text messages with friends, family, and colleagues.",
  "Yes, we offer a free version with basic features.",
  "To start a video call, click any server voice chanel you want to join and will automatically join to selected call.",
  "No, in cex you cant record your videocalls.",
  "In Cex theres no people limit for videocalls.",
  'To send a message, select the contact/chanel, type your message in the text box, and press "Enter" or "Send icon".',
  "At the moment we have not support sending media messages.",
  "No, block system hasn't been implemented but you can kick members from your servers.",
  "To create an account, visit our registration page and complete the required fields",
  "Yes, you can change your username in your account settings anytime.",
  "Yes but we reccomend using your pc to connect to Cex",
];

let type = 1;

phrases.forEach((p, index) => {
  p.addEventListener("click", function () {
    second.style.transform = type === 1 ? "rotateY(360deg)" : "rotateY(0deg)";
    phrases.forEach((element) => {
      element.style.transform = "translateX(0)";
    });
    this.style.transform = "translateX(20px)";

    setTimeout(() => {
      second.innerHTML = newContent[index];
    }, 100); // Halfway through the 0.6s transition

    type = type === 1 ? 2 : 1;
  });
});

const logo = document.querySelector(".logo");
logo.addEventListener("click", function () {
  window.location.href = "..";
});
