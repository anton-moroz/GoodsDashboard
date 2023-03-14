/**
 * Classes used to make elements visible/invisible with animation.
 *
 * @type {string[]}
 */
const visibilityClasses = ['opacity-0', 'h-0'];

/**
 * Make an element visible while preserving animations.
 *
 * @param {HTMLElement} elem - The element to make visible.
 */
function makeVisible(elem) {
  elem.classList.remove('hidden');
  visibilityClasses.map((item) => elem.classList.remove(item));
}

/**
 * Make an element invisible while preserving animations.
 *
 * @param {HTMLElement} elem - The element to make invisible.
 * @param {number} [delay=300] - The delay in milliseconds before
 * making the element hidden.
 */
function makeInvisible(elem, delay = 300) {
  visibilityClasses.map((item) => elem.classList.add(item));
  setTimeout(() => elem.classList.add('hidden'), delay);
}

/**
 * Adds a click event listener to the specified element that toggles
 * the visibility of the target element with animation.
 *
 * @param {HTMLElement} clickElem - The element to add click event listener to.
 * @param {HTMLElement} targetElem - The element to toggle visibility.
 */
export default function addToggleVisibilityListener(clickElem, targetElem) {
  clickElem.addEventListener('click', () => {
    if (targetElem.classList.contains('hidden')) {
      makeVisible(targetElem);
    } else {
      makeInvisible(targetElem);
    }
  });
}
