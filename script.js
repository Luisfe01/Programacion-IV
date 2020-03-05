(function() {

    var lastId = 0;
    var taskWrapper = document.getElementById("tabla");
    var btnSave = document.getElementById("guardar");
    var removeIcon;
    var updateIcon;
    var alumnList;
  
    function init() {
  
      if (!!(window.localStorage.getItem('alumnList'))) {
        alumnList = JSON.parse(window.localStorage.getItem('alumnList'));
      } else {
        alumnList = [];
      }
      btnSave.addEventListener('click', saveTask);
      showList();
    }
  
    function showList() {
  
      if (!!alumnList.length) {
        getLastTaskId();
        for (var item in alumnList) {
          var task = alumnList[item];
          addTaskToList(task);
        }
        syncEvents();
      }
      
    }
  
    function saveTask(event) {
  
      let codigo = document.querySelector("#codigo").value,
      nombre = document.querySelector("#nombre").value,
      direccion = document.querySelector("#direccion").value,
      telefono = document.querySelector("#telefono").value;


      if (codigo.length === 0 || nombre.length === 0 || direccion.length === 0 || telefono.length === 0) return;

      var task = {
        taskId: lastId,
        codigo: codigo,
        nombre: nombre,
        direccion: direccion,
        telefono: telefono
      };

      alumnList.push(task);
      syncTask();
      addTaskToList(task);
      syncEvents();
      lastId++;
    }
  
    function addTaskToList(task) {
  
      var removeIcon = document.createElement('span');
      var element = document.createElement('li');
      var updateIcon = document.createElement('span');
  
      removeIcon.innerHTML = "Eliminar";
      removeIcon.className = "remove_item clickeable";
      removeIcon.setAttribute("title", "Remove");
  
      updateIcon.innerHTML = "Actualizar";
      updateIcon.className = "update_icon clickeable";
      updateIcon.setAttribute("title", "Update");
  
      
      element.setAttribute("id", task.taskId);
      element.innerHTML += task.codigo + " " + task.nombre + " " + task.direccion + " " + task.telefono;
      element.appendChild(removeIcon);
      element.appendChild(updateIcon);
      taskWrapper.appendChild(element);
      
    }
  
    function updateTask(event) {
  
      var taskTag = event.currentTarget.parentNode;
      var taskId = taskTag.id;
      var taskToUpdate = findTask(taskId).task;
      var pos = findTask(taskId).pos;
      if (!!taskToUpdate) {
        var cod = prompt("Codigo", taskToUpdate.codigo);
        var name = prompt("Nombre", taskToUpdate.nombre);
        var dir = prompt("Direccion", taskToUpdate.direccion);
        var tel = prompt("Telefono", taskToUpdate.telefono);

        taskToUpdate.codigo = cod;
        taskToUpdate.nombre = name;
        taskToUpdate.direccion = dir;
        taskToUpdate.telefono = tel;
        
        alumnList[pos] = taskToUpdate;
        taskTag.firstChild.textContent = taskToUpdate.codigo + " " + taskToUpdate.nombre + " " + taskToUpdate.direccion + " " + taskToUpdate.telefono;


        
        syncTask();
        

      }
    }
  
    function removeTask(event) {
  
      var taskToRemove = event.currentTarget.parentNode;
      var taskId = taskToRemove.id;
      taskWrapper.removeChild(taskToRemove);
      alumnList.forEach(function(value, i) {
        if (value.taskId == taskId) {
          alumnList.splice(i, 1);
        }
      })
  
      syncTask();
    }
  
  
    function syncTask() {
  
      window.localStorage.setItem('alumnList', JSON.stringify(alumnList));
      alumnList = JSON.parse(window.localStorage.getItem('alumnList'));
    }
  
    function getLastTaskId() {
      var lastTask = alumnList[alumnList.length - 1];
      lastId = lastTask.taskId + 1;
    }
  
    function syncEvents() {
  
      updateIcon = document.getElementsByClassName("update_icon");
      removeIcon = document.getElementsByClassName("remove_item");
      if (!!removeIcon.length) {
        for (var i = 0; i < removeIcon.length; i++) {
          removeIcon[i].addEventListener('click', removeTask);
        }
      }
      if (!!updateIcon.length) {
        for (var j = 0; j < updateIcon.length; j++) {
          updateIcon[j].addEventListener('click', updateTask);
        }
      }
    }
  
    function findTask(id) {
  
      var response = {
        task: '',
        pos: 0
      };
      alumnList.forEach(function(value, i) {
        if (value.taskId == id) {
          response.task = value;
          response.pos = i;
        }
      });
  
      return response;
    }
  
  
  
    init();
  
  
  })();

  ///