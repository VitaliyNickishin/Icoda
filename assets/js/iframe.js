let tag = document.createElement("script");

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

let player;
// let storage = localStorage.getItem("language");

$(".play-icon").on("click", function (e) {
  e.preventDefault();

  let btn = $(this).parent(),
    videoID = btn.data("video"),
    playerID = btn.data("id");

  player = new YT.Player(playerID, {
    playerVars: {
      controls: 0,
      showinfo: 0,
      disablekb: 1,
      rel: 0,
      playsinline: 1,
      origin: "https://icoda.io/",
      host: "https://www.youtube.com",
    },
    videoId: videoID,
    events: {
      onReady: onPlayerReady,
    },
  });
});

function onPlayerReady(event) {
  let video = event.target.getIframe();
  console.log("video", video);
  $(video).siblings(".poster").addClass("removed");
  $(video).parent(".video").addClass("active");
  event.target.playVideo();
}
