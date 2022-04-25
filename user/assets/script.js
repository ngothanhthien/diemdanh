function setCssSidebar(currentTabId){
    sidebarTabs=document.getElementsByClassName("sidebar");
    for(var i=0;i<sidebarTabs.length;i++){
        if(sidebarTabs[i].id!=currentTabId){
            sidebarTabs[i].classList.add("inactiveSideBar");
        }else{
           sidebarTabs[i].classList.add("activeSideBar");
        }
    }
}