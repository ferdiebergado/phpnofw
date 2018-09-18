<script type="text/javascript">
  // register Focusable jQuery extension
  jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
      return $(el).is('a, button, :input, [tabindex]');
    }
  });

  // Disable form submit on pressing Enter key
  $('form').on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
      e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(document.activeElement) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
      }
    });

  // Focus the first element that has an error.
  $('.has-error:first input').focus();

  // Automatically dismiss alerts after several seconds
  $("#divAlert").delay(4000).fadeOut(600);
</script>
