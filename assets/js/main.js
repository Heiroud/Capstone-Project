(function(){
   "use strict";
 
  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }
 
  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }
 
  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function(e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Search bar toggle
   */
  if (select('.search-bar-toggle')) {
    on('click', '.search-bar-toggle', function(e) {
      select('.search-bar').classList.toggle('search-bar-show')
    })
  }
 
 })();


 /**
 * Nav tab refresh script
 */
document.addEventListener("DOMContentLoaded", function() {
  const tabButtons = document.querySelectorAll('.nav-tabs .nav-link');

  function handleTabClick(event) {
    tabButtons.forEach(button => {
      button.classList.remove('active');
    });

    event.currentTarget.classList.add('active');

    const tabContents = document.querySelectorAll('.tab-pane');
    tabContents.forEach(content => {
      content.classList.remove('show', 'active');
    });

    const targetTab = document.querySelector(event.currentTarget.getAttribute('data-bs-target'));
    targetTab.classList.add('show', 'active');

    sessionStorage.setItem('activeTab', event.currentTarget.getAttribute('data-bs-target'));
  }

  tabButtons.forEach(button => {
    button.addEventListener('click', handleTabClick);
  });

  const activeTab = sessionStorage.getItem('activeTab');
  if (activeTab) {
    const activeTabButton = document.querySelector(`[data-bs-target="${activeTab}"]`);
    if (activeTabButton) {
      activeTabButton.click();
    }
  }
});