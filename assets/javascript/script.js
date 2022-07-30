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
    this.audioHtmlElement.addEventListener('volumechange', () => {
      this.updateVolumeProgressBar(this.audioHtmlElement.volume);
    });
    this.audioHtmlElement.addEventListener('ended', () => {
      nextSong(true);
    });
  }

  setTrack(track) {
    this.currentlyPlaying = track;
    this.audioHtmlElement.src = `${track.path}.mp3`;
  }

  playSong() {
    console.log('play');
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
    document.querySelector(
      '[data-nowPlaying="progress-bar-foreground"]'
    ).style.width = `${progressTimePercentage}%`;
  }

  setVolumeProgressBarMute(mute) {
    if (mute) {
      this.audioHtmlElement.volume = 0;
    } else {
      this.audioHtmlElement.dispatchEvent(new Event('volumechange'));
    }
  }

  updateVolumeProgressBar(audioVolume) {
    const volume = audioVolume * 100;
    document.querySelector(
      '[data-nowPlaying="volume-bar-foreground"]'
    ).style.width = `${volume}%`;
  }

  setTime(seconds) {
    this.audioHtmlElement.currentTime = seconds;
  }

  shuffleArray(array) {
    console.log(array);
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
  }
}

// const audioElement = new Audio();

// audioElement.setTrack('assets/music/music_0.mp3');

// document.body.addEventListener('mousemove', function () {
//   audioElement.audioElement.play();
// });

const getUserLoggedIn = async () => {
  try {
    const loggedIn = await fetch(
      'http://localhost/php_spotify_clone/includes/ajax/getLoginJson.php',
      {
        method: 'get',
      }
    );
    console.log(loggedIn);
    const loggedInJson = await loggedIn.json();
    console.log(loggedInJson);
    return loggedInJson;
  } catch (error) {
    console.error(error);
  }
};

const openPage = async (url, element = null) => {
  clearTimers(runningTimers);
  try {
    console.log(url + ' hshhshshs');
    const userLoggedIn = await getUserLoggedIn();

    if (url.indexOf('?') === -1) {
      url = `${url}?`;
    }
    console.log(userLoggedIn);
    const encodedUrl = encodeURI(`${url}&userLoggedIn=${userLoggedIn}`);
    // const encodedUrl = encodeURI(`${url}`);

    console.log(encodedUrl);
    const getPage = await fetch(`${encodedUrl}`, {
      method: 'get',
      type: 'text',
    });
    console.log(`http://localhost/php_spotify_clone/${encodedUrl}`);
    const getPageHtml = await getPage.text();
    // console.log(getPageHtml);
    document.querySelector('[data-main-content]').innerHTML = getPageHtml;
    console.log(document.querySelector('body'));
    document.querySelector('body').scrollTop = 0;
    console.log(url.lastIndexOf('/'));
    const pushUrl = url.slice(url.lastIndexOf('/') + 1, url.length - 1);
    console.log(pushUrl);
    // history.pushState(null, null, `http://localhost/php_spotify_clone/`);
    // console.log(history);

    console.log('pageChange');
    if (element) {
      document.querySelector(`.${element.className}`).focus();
    }
  } catch (error) {
    console.error(error);
  }
};

const playArtistPlaylist = () => {
  setTrack(tempPlaylist[0], tempPlaylist, true);
};

const clearTimers = (arr) => {
  if (arr.length === 0) {
    return;
  }

  arr.forEach((timer) => {
    clearTimeout(timer);
  });
};

const searchHandler = (element) => {
  if (element.value === '') {
    return;
  }
  clearTimers(runningTimers);
  const timer = setTimeout(() => {
    openPage(`includes/html/searchContent.php?term=${element.value}`, element);
  }, 2000);
  runningTimers.push(timer);
};

const createPlaylist = async () => {
  const userLoggedIn = await getUserLoggedIn();
  const popup = prompt('Please enter the name of your playlist');
  try {
    if (popup != null) {
      console.log(popup);
    }

    const data = {
      name: popup,
      username: userLoggedIn,
    };

    console.log(data);

    const send = await fetch('includes/ajax/createPlaylist.php', {
      method: 'POST',
      body: JSON.stringify(data),
      // name: JSON.stringify(popup),
      // username: JSON.stringify(userLoggedIn),
    });

    const sendJson = await send.text();

    console.log(sendJson);

    openPage('includes/html/yourMusicContent.php');
  } catch (error) {
    console.error(error);
  }
};

const runningTimers = [];
let currentPlaylist = [];
let shufflePlaylist = [];
let tempPlaylist = [];
let audioElement;
let mouseDown = false;
let currentPlaylistIndex = 0;
let repeat = false;
let shuffle = false;
// openPage();
console.log('hello script');
