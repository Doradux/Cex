function copyLink(link) {
  var link = "https://driving-oralle-cex-1b62d5bf.koyeb.app/?join=" + link;
  navigator.clipboard.writeText(link);
  event.target.innerHTML = "COPIED!";
}
