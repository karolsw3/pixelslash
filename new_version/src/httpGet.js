export default theUrl => new Promise((resolve) => {
  const request = new XMLHttpRequest();
  request.addEventListener('load', () => {
    if (request.readyState === 4 && request.status === 200) {
      resolve(request.responseText);
    }
  });
  request.open('GET', theUrl, true);
  request.send(null);
});
