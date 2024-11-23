
var elementMember, elementplan, elementoverview, elementroutine;
var memcount = 0,
  plancount = 0,
  overviewcount = 0,
  routinecount = 0;

  document.addEventListener("DOMContentLoaded", () => {
    const subMenus = {
      member: { element: null, expanded: false },
      plan: { element: null, expanded: false },
      overview: { element: null, expanded: false },
      routine: { element: null, expanded: false }
    };
  
    // Initialize elements
    Object.keys(subMenus).forEach(key => {
      const id = key === 'member' ? 'hassubopen' : `${key}hassubopen`;
      subMenus[key].element = document.getElementById(id);
    });
  
    // Setup click handlers for submenu toggles
    document.querySelectorAll('.has-submenu > a').forEach(toggle => {
      toggle.addEventListener('click', (e) => {
        e.preventDefault();
        const menu = toggle.parentElement;
        const menuType = getMenuType(menu);
        
        if (menuType) {
          // Close other menus
          Object.keys(subMenus).forEach(key => {
            if (key !== menuType && subMenus[key].expanded) {
              closeSubmenu(key);
            }
          });
          
          // Toggle current menu
          toggleSubmenu(menuType);
        }
      });
    });
  
    function getMenuType(menu) {
      if (menu.id === 'hassubopen') return 'member';
      return Object.keys(subMenus).find(key => menu.id === `${key}hassubopen`);
    }
  
    function toggleSubmenu(type) {
      const menu = subMenus[type];
      if (!menu.expanded) {
        menu.element.className = menu.element.className.replace('has-sub', 'has-sub opened');
        document.getElementById(`${type}Expand`).className = 'visible';
        menu.expanded = true;
      } else {
        closeSubmenu(type);
      }
    }
  
    function closeSubmenu(type) {
      const menu = subMenus[type];
      menu.element.className = menu.element.className.replace('has-sub opened', 'has-sub');
      document.getElementById(`${type}Expand`).className = '';
      menu.expanded = false;
    }
  });

document.addEventListener("DOMContentLoaded", () => {
  initializeModernNav();
  initializeMember();
});

function initializeModernNav() {
    document.querySelectorAll('.has-submenu > a').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const parent = item.parentElement;
            const submenu = parent.querySelector('.submenu');
            
            // Close other submenus
            document.querySelectorAll('.has-submenu.active').forEach(menu => {
                if (menu !== parent) {
                    menu.classList.remove('active');
                    menu.querySelector('.submenu').style.display = 'none';
                }
            });
            
            // Toggle current submenu
            parent.classList.toggle('active');
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        });
    });
}

function handleSubMenuState(isExpanded) {
  const elements = {
    member: { el: elementMember, count: memcount },
    plan: { el: elementplan, count: plancount },
    overview: { el: elementoverview, count: overviewcount },
    routine: { el: elementroutine, count: routinecount },
  };

  Object.values(elements).forEach(({ el, count }) => {
    if (el) {
      if (isExpanded) {
        el.className = el.className.replace(
          "",
          count ? "has-sub opened" : "has-sub"
        );
      } else {
        el.className = el.className.replace(
          count ? "has-sub opened" : "has-sub",
          ""
        );
      }
    }
  });
}

function initializeMember() {
  elementMember = document.getElementById("hassubopen");
  elementplan = document.getElementById("planhassubopen");
  elementoverview = document.getElementById("overviewhassubopen");
  elementroutine = document.getElementById("routinehassubopen");
}

var memcount = 0;
var plancount = 0;
var overviewcount = 0;
var routinecount = 0;

function memberExpand(passvalue) {
  if (passvalue == 1) {
    if (memcount == 0) {
      if (plancount == 1) {
        elementplan.className = elementplan.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("planExpand");
        element.className = element.className.replace("visible", "");
        plancount = 0;
      }
      if (overviewcount == 1) {
        elementoverview.className = elementoverview.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("overviewExpand");
        element.className = element.className.replace("visible", "");
        overviewcount = 0;
      }
      if (routinecount == 1) {
        elementroutine.className = elementroutine.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("routineExpand");
        element.className = element.className.replace("visible", "");
        routinecount = 0;
      }

      elementMember.className = elementMember.className.replace(
        "has-sub",
        "has-sub opened"
      );

      var element = document.getElementById("memExpand");
      element.className = element.className.replace("", "visible");
      memcount = 1;
    } else if (memcount == 1) {
      elementMember.className = elementMember.className.replace(
        "has-sub opened",
        "has-sub"
      );

      var element = document.getElementById("memExpand");
      element.className = element.className.replace("visible", "");
      memcount = 0;
    }
  } else if (passvalue == 2) {
    if (plancount == 0) {
      if (memcount == 1) {
        elementMember.className = elementMember.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("memExpand");
        element.className = element.className.replace("visible", "");
        memcount = 0;
      }
      if (overviewcount == 1) {
        elementoverview.className = elementoverview.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("overviewExpand");
        element.className = element.className.replace("visible", "");
        overviewcount = 0;
      }
      if (routinecount == 1) {
        elementroutine.className = elementroutine.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("routineExpand");
        element.className = element.className.replace("visible", "");
        routinecount = 0;
      }

      elementplan.className = elementplan.className.replace(
        "has-sub",
        "has-sub opened"
      );

      var element2 = document.getElementById("planExpand");
      element2.className = element2.className.replace("", "visible");
      plancount = 1;
    } else if (plancount == 1) {
      elementplan.className = elementplan.className.replace(
        "has-sub opened",
        "has-sub"
      );

      var element2 = document.getElementById("planExpand");
      element2.className = element2.className.replace("visible", "");
      plancount = 0;
    }
  } else if (passvalue == 3) {
    if (overviewcount == 0) {
      if (plancount == 1) {
        elementplan.className = elementplan.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("planExpand");
        element.className = element.className.replace("visible", "");
        plancount = 0;
      }
      if (memcount == 1) {
        elementMember.className = elementMember.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("memExpand");
        element.className = element.className.replace("visible", "");
        memcount = 0;
      }
      if (routinecount == 1) {
        elementroutine.className = elementroutine.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("routineExpand");
        element.className = element.className.replace("visible", "");
        routinecount = 0;
      }

      elementoverview.className = elementoverview.className.replace(
        "has-sub",
        "has-sub opened"
      );

      var element3 = document.getElementById("overviewExpand");
      element3.className = element3.className.replace("", "visible");
      overviewcount = 1;
    } else if (overviewcount == 1) {
      elementoverview.className = elementoverview.className.replace(
        "has-sub opened",
        "has-sub"
      );

      var element3 = document.getElementById("overviewExpand");
      element3.className = element3.className.replace("visible", "");
      overviewcount = 0;
    }
  } else if (passvalue == 4) {
    if (routinecount == 0) {
      if (plancount == 1) {
        elementplan.className = elementplan.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("planExpand");
        element.className = element.className.replace("visible", "");
        plancount = 0;
      }
      if (overviewcount == 1) {
        elementoverview.className = elementoverview.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("overviewExpand");
        element.className = element.className.replace("visible", "");
        overviewcount = 0;
      }
      if (memcount == 1) {
        elementMember.className = elementMember.className.replace(
          "has-sub opened",
          "has-sub"
        );

        var element = document.getElementById("memExpand");
        element.className = element.className.replace("visible", "");
        memcount = 0;
      }

      elementroutine.className = elementroutine.className.replace(
        "has-sub",
        "has-sub opened"
      );

      var element4 = document.getElementById("routineExpand");
      element4.className = element4.className.replace("", "visible");
      routinecount = 1;
    } else if (routinecount == 1) {
      elementroutine.className = elementroutine.className.replace(
        "has-sub opened",
        "has-sub"
      );

      var element4 = document.getElementById("routineExpand");
      element4.className = element4.className.replace("visible", "");
      routinecount = 0;
    }
  }
}
