const init = () => {
    const navbar: any = document.getElementById("navbar");
    let activeTab: number =  0;
    console.log(activeTab)
    for(const tab of navbar.children) {
        tab.addEventListener("click", switchTabs);
    }
};

const switchTabs = (event: any) => {
    document.querySelector("#navbar>.active").classList.remove("active");
    document.querySelector(".tab-content>.active").classList.remove("active");
    event.currentTarget.classList.add("active");
    const tab = event.currentTarget.getAttribute("data-tab");
    document.getElementById(tab).classList.add("active");
};

export {
    init
};