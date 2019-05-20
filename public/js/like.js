function eventListenerLike() {
  data = $(this).val()
  //var arr = data.split();
  $.ajax({
    type: "GET",
    url: "/like",
    data: {
      'data': data
    },
    dataType: "text",
    success: function (msg) {
      $('#like').html(msg);
    }
  });
}

$(document).ready(function () {
  $('#like').click(eventListenerLike);
});
