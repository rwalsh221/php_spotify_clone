class Audio {
  constructor(currentlyPlaying) {
    this.currentlyPlaying = currentlyPlaying;
    this.audioHtmlElement = document.createElement('audio');
    this.audioHtmlElement.addEventListener('canplay', () => {
      document.querySelector(
        '[data-nowPlaying="progress-time-rem"]'
      ).textContent = this.formatTime(this.audioHtmlElement.duration);
    });
    this.audioHtmlElement.addEventListener('timeupdate', () => {
      if (this.audioHtmlElement.duration) {
        this.updateTimeProgressBar(this.audioHtmlElement);
      }
    });
  }

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

  formatTime(songLength) {
    const time = Math.round(songLength);
    const minutes = Math.floor(time / 60);
    const seconds = time - minutes * 60;
    return seconds < 10 ? `${minutes}:0${seconds}` : `${minutes}:${seconds}`;
  }

  updateTimeProgressBar(audio) {
    document.querySelector(
      '[data-nowPlaying="progress-time-curr"]'
    ).textContent = this.formatTime(audio.currentTime);

    document.querySelector(
      '[data-nowPlaying="progress-time-rem"]'
    ).textContent = this.formatTime(audio.duration - audio.currentTime);

    // song progress in percent
    const progressTimePercentage = (audio.currentTime / audio.duration) * 100;
    console.log(progressTimePercentage);
    document.querySelector(
      '[data-nowPlaying="progress-time-bar"]'
    ).style.width = `${progressTimePercentage}%`;
  }
}

// const audioElement = new Audio();

// audioElement.setTrack('assets/music/music_0.mp3');

// document.body.addEventListener('mousemove', function () {
//   audioElement.audioElement.play();
// });

let currentPlaylist = [];
let audioElement;
