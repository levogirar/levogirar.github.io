// Script for horizontal drag for the Wuwana section in the homepage

// const slider = document.getElementsByClassName('.wuwana');
// let mouseDown = false;
// let startX, scrollLeft;

// let startDragging = function (e) {
//   mouseDown = true;
//   startX = e.pageX - slider.offsetLeft;
//   scrollLeft = slider.scrollLeft;
// };
// let stopDragging = function (event) {
//   mouseDown = false;
// };

// slider.addEventListener('mousemove', (e) => {
//   e.preventDefault();
//   if(!mouseDown) { return; }
//   const x = e.pageX - slider.offsetLeft;
//   const scroll = x - startX;
//   slider.scrollLeft = scrollLeft - scroll;
// });

// // Add the event listeners
// slider.addEventListener('mousedown', startDragging, false);
// slider.addEventListener('mouseup', stopDragging, false);
// slider.addEventListener('mouseleave', stopDragging, false);

// const slider = document.getElementsByClassName('.wuwana-wrapper');
// let isDown = false;
// let startX;
// let scrollLeft;

// slider.addEventListener('mousedown', () => {
//     isDown = true;
// });
// slider.addEventListener('mouseleave', () => {
//     isDown = false;
// });
// slider.addEventListener('mouseup', () => {
//     isDown = false;
// });
// slider.addEventListener('mousemove', () => {
//     console.log(isDown);
//     console.log('Do work!');
// });
