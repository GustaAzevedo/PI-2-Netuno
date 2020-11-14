window.onload = (event) => {
  animateMenu()
};

function animateMenu() {
  const navItems = document.querySelectorAll('.nav__item')

  navItems.forEach(item => {
    item.addEventListener('click', function(){
      console.log(this)
      if (this.classList.contains('hide-children')){
        this.classList.remove('hide-children');
      } else {
        this.classList.add('hide-children');
      }
    })
  })
}