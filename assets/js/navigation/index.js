import addToggleVisibilityListener from '../helpers/visibility';

const userMenuButton = document.querySelector('#user-menu-button');
const userMenuDropdown = document.querySelector('#user-menu-dropdown');
const mobileMenuButton = document.querySelector('#mobile-menu-button');
const mobileMenuDropdown = document.querySelector('#mobile-menu');

/**
 * Initiate mobile and profile navigation menus.
 */
export default function initiateNavigation() {
  addToggleVisibilityListener(userMenuButton, userMenuDropdown);
  addToggleVisibilityListener(mobileMenuButton, mobileMenuDropdown);
}
