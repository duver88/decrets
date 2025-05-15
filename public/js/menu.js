window.addEventListener("load", function() {
  initMenu();
});

function initMenu() {
  initSearchBar();

  document.querySelectorAll('.dropdown-menu').forEach(function(element){
    element.addEventListener('click', function (e) {
      e.stopPropagation();
    });
  });

  document.querySelectorAll('.navbar-menu-govco a.dir-menu-govco').forEach(function(element){
    element.addEventListener("click", eventClickItem, false);
  });
}

function eventClickItem() {
  const parentNavbar = this.closest('.navbar-menu-govco');
  parentNavbar.querySelectorAll('a.active').forEach(function(element){
    element.classList.remove('active');
  });

  this.classList.add('active');
}

function initSearchBar() {
  const inputSearch = document.querySelectorAll(".input-search-govco:not(.noActive)");
  getElementInputSearchBar(inputSearch);
  methodAssign("keyup", activeInputSearchBar, inputSearch);
  methodAssign("keydown", keydownInputSearchBar, inputSearch);
  methodAssign("blur", blurInputSearchBar, inputSearch);
  methodAssign("focus", focusInputSearchBar, inputSearch);

  const buttonClean = document.querySelectorAll(".search-govco .icon-close-search-govco");
  methodAssign("click", cleanInputSearchBar, buttonClean);
  methodAssign("blur", blurcleanInputSearchBar, buttonClean);
}
