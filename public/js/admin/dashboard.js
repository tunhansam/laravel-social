
$(function () {

  $('.dropdown-toggle').on('click',  function() {
      $('.user-menu .dropdown-menu').slideToggle();
  });
});
/* Ajax loader */
function makeUrl(url) {
  if (url.indexOf('?') < 0) {
    if (url.indexOf('&') >= 0) {
      url = url.replace('&', '?');
    }
  }
  return url;
}
function cutObjURL(obj, url) {
    obj = obj + '=';
    var arr = {};
    // Object is found
    if (url.indexOf(obj) > 0) {
        // Get value of OBJ in url (Lấy giá trị của đối tượng trong url - phần sau dấu =)
        arr.obj = url.slice(url.indexOf(obj) + obj.length);
        // Get new url after cut (Cut from the begin to the location found)
        arr.url = url.slice(0, url.indexOf(obj) - 1);
    } else {
        arr.obj = '';
        arr.url = url;
    }
    return arr;
}
// Create URL for object
function createObjURL(key, value) {
  var obj = {};
  if (value.trim().length == 0) {
    obj.url = '';
  } else {
    obj.url = '&' + key + '=' + value;
  }
  return obj;
}

// Change the number element of page ($limit). Don't reload page
function limitChanged(obj) {
    var currentURL = window.location.toString();
    page = new cutObjURL('page', currentURL);
    limit = new cutObjURL('display', page.url);
    var url = makeUrl(limit.url + '&display=' + obj.value);
    getData(url);
    window.history.pushState("", "", url);
}

// Get name image from url
function getImage(obj) {
    temp = obj.split('\\');
    obj = temp[temp.length - 1]; 
    document.getElementById('nameAvatar').innerHTML = obj;
} 

// Pagination AJAX, don't reload page
$('.box-body').on('click', '.pagination a', function(e) {
    // Prevent the link load page
    e.preventDefault();
    var url = $(this).attr('href');  
    getData(url);
    window.history.pushState("", "", url);
});

function getData(url) {
    $.ajax({
        url : url 
    }).done(function (data) {
        $('body').html(data);  
     }).fail(function () {
        alert('Data could not be loaded.');
    });
}