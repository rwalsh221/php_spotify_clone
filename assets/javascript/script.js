class Audio {
  constructor(currentlyPlaying) {
    this.currentlyPlaying = currentlyPlaying;
  }
  audioHtmlElement = document.createElement('audio');
  setTrack(track) {
    this.currentlyPlaying = track;
    this.audioHtmlElement.src = `${track.path}.mp3`;
  }
  playSong() {
    this.audioHtmlElement.play();
  }
  pauseSong() {
    this.audioHtmlElement.pause();
  }
}

// const audioElement = new Audio();

// audioElement.setTrack('assets/music/music_0.mp3');

// document.body.addEventListener('mousemove', function () {
//   audioElement.audioElement.play();
// });

let currentPlaylist = [];
let audioElement;
