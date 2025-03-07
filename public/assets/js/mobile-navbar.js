class MobileNavbar {
    constructor(mobileMenu, navlist, navlinks, closeBtn) {
        this.mobileMenu = document.querySelector(mobileMenu);
        this.navlist = document.querySelector(navlist);
        this.navlinks = document.querySelectorAll(navlinks);
        this.closeBtn = document.querySelector(closeBtn);
        this.activeClass = "active";

        this.handleClick = this.handleClick.bind(this);
        this.handleClose = this.handleClose.bind(this);
    }

    animateLinks() {
        this.navlinks.forEach((link, index) => {
            link.style.animation
                ? (link.style.animation = "")
                : (link.style.animation = `navLinkFade 0.5s ease forwards ${index * 0.1}s`);
        });
    }

    handleClick() {
        this.navlist.classList.toggle(this.activeClass);
        this.mobileMenu.classList.toggle(this.activeClass);
        this.animateLinks();
    }

    handleClose() {
        this.navlist.classList.remove(this.activeClass);
        this.mobileMenu.classList.remove(this.activeClass);
        this.animateLinks();
    }

    addClickEvent() {
        this.mobileMenu.addEventListener("click", this.handleClick);
        if (this.closeBtn) {
            this.closeBtn.addEventListener("click", this.handleClose);
        }
    }

    init() {
        if (this.mobileMenu) {
            this.addClickEvent();
        }
        return this;
    }
}

const mobileNavbarInstance = new MobileNavbar(
    ".mobile-menu",
    ".nav-list",
    ".nav-list li",
    ".close-btn"
);

mobileNavbarInstance.init();
