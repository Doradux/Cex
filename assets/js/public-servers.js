function copyLink(link) {
  var link = "localhost?join=" + link;
  navigator.clipboard.writeText(link);
  event.target.innerHTML = "COPIED!";
}
