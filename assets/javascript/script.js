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
    const data = {
      name: popup,
      username: userLoggedIn,
    };

    const send = await fetch(
      'http://localhost/php_spotify_clone/includes/ajax/createPlaylist.php',
      {
        method: 'POST',
        body: JSON.stringify(data),
        // name: JSON.stringify(popup),
        // username: JSON.stringify(userLoggedIn),
      }
    );

    openPage('includes/html/yourMusicContent.php');
  } catch (error) {
    console.error(error);
  }
};

const deletePlaylist = async (playlistId) => {
  const prompt = confirm('Are ou sure you want to delete the playlist');

  if (prompt === true) {
    try {
      const data = {
        playlistId,
      };

      const send = await fetch('includes/ajax/deletePlaylist.php', {
        method: 'POST',
        body: JSON.stringify(data),
      });

      openPage('includes/html/yourMusicContent.php');
    } catch (error) {
      console.error(error);
    }
  }
};

const resetNavHtml = (resetPlaylistNavHtml = false) => {
  const nav = document.querySelector('[data-nav="options-menu"]');
  const navHtml = `<div class="options-menu__items" onclick="selectPlaylist(this)" data-nav="options-item">Add to playlist</div>
  <div class="options-menu__items">Item 2</div>
  <div class="options-menu__items">Item 3</div>`;

  const playlistNavHtml = `<div class="options-menu__items" onclick="selectPlaylist(this)" data-nav="options-item">Add to playlist</div>
  <div class="options-menu__items" data-playlist-id="<?php echo $playlistId; ?>" onclick="removeSongFromPlaylist(this)" data-nav="options-item">Remove From Playlist</div>
  <div class="options-menu__items">Item 3</div>`;

  while (nav.firstChild) {
    nav.removeChild(nav.lastChild);
  }

  if (resetPlaylistNavHtml) {
    console.log('hello rest playlist is true');
    nav.insertAdjacentHTML('beforeend', playlistNavHtml);
  } else {
    nav.insertAdjacentHTML('beforeend', navHtml);
  }
};

const closeSongOptionMenu = (event) => {
  const menu = document.querySelector('[data-nav="options-menu"]');
  // CHECK FOR CLICK ON SONG OPTION MENU
  if (
    event &&
    event.type === 'click' &&
    event.target.dataset.hasOwnProperty('nav')
  ) {
    return;
  }

  menu.style.display = 'none';

  resetNavHtml(menu.dataset.playlistOptions);

  window.removeEventListener('click', closeSongOptionMenu, true);
  window.removeEventListener('scroll', closeSongOptionMenu, true);
};

const showSongOptionsMenu = (element) => {
  const menu = document.querySelector('[data-nav="options-menu"]');
  menu.style.display = 'block';

  const horizontalOffset = element.getBoundingClientRect().x - menu.offsetWidth;
  const verticalOffset = element.getBoundingClientRect().y;

  menu.style.left = `${horizontalOffset}px`;
  menu.style.top = `${verticalOffset}px`;

  // GET ID OF SONG TO ADD TO PLAYLIST
  menu.dataset.songId = element.dataset.songId;

  // CANT USE ANYMOUS FUNC TO REMOVE EVENTLISTNER
  window.addEventListener('click', closeSongOptionMenu, true);
  window.addEventListener('scroll', closeSongOptionMenu, true);
};

const selectPlaylist = async (element) => {
  try {
    const parentElement = element.parentNode;

    const userLoggedIn = await getUserLoggedIn();

    const data = {
      username: userLoggedIn,
    };

    const playlists = await fetch('includes/ajax/getPlaylists.php', {
      method: 'POST',
      body: JSON.stringify(data),
    });

    const playlistsJson = await playlists.json();

    // REMOVE ALL OPTIONS FROM MENU
    while (parentElement.firstChild) {
      parentElement.removeChild(parentElement.lastChild);
    }

    // REPLACE OPTIONS WITH PLAYLISTS
    playlistsJson.forEach((playlist) => {
      const newDiv = document.createElement('div');
      newDiv.innerText = playlist.name;
      newDiv.classList.add('options-menu__items');
      newDiv.dataset.playlistId = `${playlist.id}`;
      newDiv.addEventListener('click', () => {
        addSongToPlaylist(parentElement.dataset.songId, playlist.id);
        // openPage(`includes/html/playlistContent.php?id=${playlist.id}`);
      });
      parentElement.appendChild(newDiv);
    });
  } catch (error) {
    console.error(error);
  }
};

const addSongToPlaylist = async (songId, playlistId) => {
  const data = {
    songId,
    playlistId,
  };

  try {
    const sendData = await fetch('includes/ajax/addSongToPlaylist.php', {
      method: 'POST',
      body: JSON.stringify(data),
    });

    // NEED TO RESET NAV HTML
    resetNavHtml();
  } catch (error) {
    console.error(error);
  }
};

const removeSongFromPlaylist = async (element) => {
  const data = {
    songId: element.parentNode.dataset.songId,
    playlistId: element.parentNode.dataset.playlistId,
  };

  try {
    const removeSong = await fetch('includes/ajax/removeSongFromPlaylist.php', {
      method: 'POST',
      body: JSON.stringify(data),
    });

    const removeSongJson = await removeSong.text();

    console.log(removeSongJson);

    resetNavHtml(true);
    closeSongOptionMenu();
    openPage(`includes/html/playlistContent.php?id=${data.playlistId}`);
  } catch (error) {
    console.error(error);
  }
};

const logout = async () => {
  try {
    const sendLogout = await fetch('includes/ajax/logout.php', {
      method: 'POST',
    });

    location.reload();
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
