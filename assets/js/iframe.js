let tag = document.createElement("script");
tag.src = "https://www.youtube.com/iframe_api";

let firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

const players = {};

$(document).on("click", ".video-trigger", function (e) {
  e.preventDefault();

  const trigger = $(this);
  const playerID = trigger.data("id");
  const videoID = trigger.data("video");

  if (players[playerID]) {
    players[playerID].playVideo();
    return;
  }

  players[playerID] = new YT.Player(playerID, {
    videoId: videoID,

    playerVars: {
      controls: 0,
      showinfo: 0,
      disablekb: 1,
      rel: 0,
      playsinline: 1,
      origin: window.location.origin,
      host: "https://www.youtube.com",
    },

    events: {
      onReady: function (event) {
        trigger.find(".poster").addClass("removed");
        trigger.closest(".video").addClass("active");
        event.target.playVideo();
      },
    },
  });
});
