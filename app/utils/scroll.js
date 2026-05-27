/**
 * Scroll utility helpers for TARO restaurant website
 */

/**
 * Smoothly scrolls to a section identified by a CSS selector (e.g. "#about")
 * @param {string} selector - The CSS selector of the target element
 * @param {Function} [callback] - Optional callback invoked after scroll is triggered
 */
export function scrollToSection(selector, callback) {
  const element = document.querySelector(selector);
  if (element) {
    element.scrollIntoView({ behavior: "smooth" });
    if (typeof callback === "function") {
      callback();
    }
  }
}

/**
 * Creates an onClick handler that prevents default anchor behavior and
 * scrolls to the given section.
 * @param {string} href - The anchor href (e.g. "#menu")
 * @param {Function} [callback] - Optional callback invoked after scrolling
 * @returns {Function} onClick event handler
 */
export function createScrollHandler(href, callback) {
  return (e) => {
    e.preventDefault();
    scrollToSection(href, callback);
  };
}
