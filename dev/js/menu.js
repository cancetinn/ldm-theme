
document.addEventListener("DOMContentLoaded", function(){
    hamburgerMenu()
    scrollActions()
})

function hamburgerMenu() {
    const hamburgerIcon = selector('.hamburger-menu')
    const sidebarMenu = selector('.sidebar-menu')

    if (!hamburgerIcon) return

    hamburgerIcon.addEventListener('click', e => {
        const getHtml = selector('html')

        e.target.classList.toggle('active')
        sidebarMenu.classList.toggle("opened")
        getHtml.classList.toggle('noscroll')
    })
}

function scrollActions() {
    const headerSticky = selector(".stickyMenu")
    const fixedSpace = selector(".fixedSpace")
    let scrollTop = 0

    window.addEventListener("scroll", () => {
        const isScrollY = window.scrollY > scrollTop

        headerSticky.classList.toggle("fixed", isScrollY)
        fixedSpace.classList.toggle("fixed", isScrollY)
    })
}
