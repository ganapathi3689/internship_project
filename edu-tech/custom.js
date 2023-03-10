
const videoList = document.getElementById('playlist');
const videoPlayer = document.getElementById('videoarea');
let activeListItem = videoList.querySelector('li');

// Set video player source to first list item's video src
const firstVideoSrc = activeListItem.getAttribute('movieurl');
videoPlayer.src = firstVideoSrc;

// Start playing video
videoPlayer.load();
videoPlayer.pause();
// videoPlayer.play();

// Update active list item
activeListItem.classList.add('active');

videoList.addEventListener('click', (event) => {
  const listItem = event.target;
  if (listItem.tagName === 'LI') {
    const videoSrc = listItem.getAttribute('movieurl');
    videoPlayer.src = videoSrc;
    videoPlayer.load();
    videoPlayer.pause();
    // videoPlayer.play();
    
    // Update active list item
    activeListItem.classList.remove('active');
    activeListItem = listItem;
    activeListItem.classList.add('active');
  }
});
