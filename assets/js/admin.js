jQuery(document).ready(function ($) {

  var countryInput = $("#acf-field_5cbb46b1ae87c");
  countryInput.countrySelect({
    defaultCountry: "xn",
    responsiveDropdown: true,
    preferredCountries: ['us', 'cn', 'ru']
  });

  countryInput.change(function () {
    var countryData = countryInput.countrySelect("getSelectedCountryData");

    $('#acf-field_5cbee23cc7cfd').val(countryData.iso2);
  });
  
  if (typeof acf === 'undefined') {
    return true;
  }


  acf.addAction('load_field/key=field_5ce5053da3956', function( field ){
    init_countries_selector(field.$el)
  });

  acf.addAction('new_field/key=field_5ce5053da3956', function( field ){
    init_countries_selector(field.$el)
  });

  acf.addAction('load_field/key=field_5ce5055ea3958', function( field ){
    init_countries_class_field(field.$el)
  });

  acf.addAction('new_field/key=field_5ce5055ea3958', function( field ){
    init_countries_class_field(field.$el)
  });

  function init_countries_selector($el) {
    var input = $el.find('input');

    //  add country select
    input.countrySelect({
      defaultCountry: "xn",
      responsiveDropdown: true,
      preferredCountries: ['us', 'cn', 'ru']
    });
  }

  function init_countries_class_field($el) {
    var classInput = $el.find('input');
    var countryInput = classInput.closest('.acf-row').find('.acf-field-5ce5053da3956 input');

    //  add country class to field
    countryInput.change(function () {
      var countryData = countryInput.countrySelect("getSelectedCountryData");

      classInput.val(countryData.iso2);
    });
  }
});