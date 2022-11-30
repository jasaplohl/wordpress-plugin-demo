const init = () => {
    const navbar: any = document.getElementById("navbar");
    if(navbar) {
        for(const tab of navbar.children) {
            tab.addEventListener("click", switchTabs);
        }
    }
};

const switchTabs = (event: any) => {
    document.querySelector(".navbar--tab__active").classList.remove("navbar--tab__active");
    document.querySelector(".tab--active").classList.remove("tab--active");
    event.currentTarget.classList.add("navbar--tab__active");
    const tab = event.currentTarget.getAttribute("data-tab");
    document.getElementById(tab).classList.add("tab--active");
};

export {
    init
};