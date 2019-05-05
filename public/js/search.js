var searchRequest = null;
var minlength = 0;

var eventListenerSearch = function () {
  var that = this,
    value = $(this).val();
  if (value.length >= minlength) {
    if (searchRequest != null)
      searchRequest.abort();
    searchRequest = $.ajax({
      type: "GET",
      url: "/search",
      data: { 'key': value },
      dataType: "text",
      success: function (msg) {
        $('#search-dropdown').html(msg);
      }
    });
  }
}

$(document).ready(function () {
  $('#search').keyup(eventListenerSearch);
  $('#search').click(eventListenerSearch);
});
