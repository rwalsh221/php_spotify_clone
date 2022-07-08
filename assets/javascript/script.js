class Audio {
  constructor(currentlyPlaying) {
    this.currentlyPlaying = currentlyPlaying;
  }
  audioHtmlElement = document.createElement('audio');
  setTrack(src) {
    this.audioHtmlElement.src = src;
  }
  playSong() {
    this.audioHtmlElement.play();
  }
}

// const audioElement = new Audio();

// audioElement.setTrack('assets/music/music_0.mp3');

// document.body.addEventListener('mousemove', function () {
//   audioElement.audioElement.play();
// });

let currentPlaylist = [];
let audioElement;
