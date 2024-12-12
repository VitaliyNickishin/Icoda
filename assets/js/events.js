var bounds, map;
var isOpened = false;

//zoom map by markers
jQuery(document).ready(function ($) {
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    if (isOpened) {
      return true;
    }

    map.fitBounds(bounds);
    isOpened = !isOpened;
  })
});

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), getSettings());

  // for markers at one place
  var oms = new OverlappingMarkerSpiderfier(map, {
    markersWontMove: true,
    markersWontHide: true,
    basicFormatEvents: true
  });

  //  show/hide markers count at one place
  oms.addListener('format', function(marker, status) {
    var label = (status === OverlappingMarkerSpiderfier.markerStatus.UNSPIDERFIED)
          ? marker.finarmEvent.label
          : '';

    marker.setLabel(label);
  });

  bounds = new google.maps.LatLngBounds();

  var iw = new google.maps.InfoWindow();
  //  from wp_localize_script
  var locations = JSON.parse(finarmEvents.markers);

  var markers = [];
  for (var index in locations) {
    var item = locations[index];
    for(var j = 0; j < item.length; j++ ){
      //  show markers count for last marker
      markers.push(addMarker(item[j], item.length, item.length === (j + 1)));
    }
  }

  map.fitBounds(bounds);

  ////
  function addMarker(props, count, isLast) {
    google.maps.event.addListener(map, 'click', function () { iw.close(); });

    var marker = new google.maps.Marker(
      {
        position: props.coords,
        map: map,
        icon: {
          labelOrigin: new google.maps.Point(15, 16),
          scaledSize: new google.maps.Size(30, 40),
          size: new google.maps.Size(30, 40),
          url: "/wp-content/themes/finarm/images/pin.png"
        },
        finarmEvent: {
          label: isLast && count !== 1 ? count.toString() : ''
        }
      }
    );

    google.maps.event.addListener(marker, 'spider_click', function(e) {  // 'spider_click', not plain 'click'
      iw.setContent(getMarker(props));
      iw.open(map, marker);
    });
    oms.addMarker(marker);  // adds the marker to the spiderfier _and_ the map

    bounds.extend(marker.getPosition());

    return marker;
  }

  function getSettings() {
    return {
      disableDefaultUI: true,
      styles: [
        {elementType: 'geometry', stylers: [{color: '#ffffff'}]},
        {elementType: 'labels.text.fill', stylers: [{color: '#919bbb'}]},
        {
          featureType: 'administrative.locality',
          elementType: 'labels.text.fill',
          stylers: [{color: '#919bbb'}]
        },
        {
          featureType: 'poi',
          elementType: 'labels.text.fill',
          stylers: [{color: '#919bbb'}]
        },
        {
          featureType: 'poi.park',
          elementType: 'geometry',
          stylers: [{color: '#ffffff'}]
        },
        {
          featureType: 'poi.park',
          elementType: 'labels.text.fill',
          stylers: [{color: '#919bbb'}]
        },
        {
          featureType: 'road',
          elementType: 'geometry',
          stylers: [{color: '#d4dbf1'}]
        },
        {
          featureType: 'road',
          elementType: 'geometry.stroke',
          stylers: [{color: '#212a37'}]
        },
        {
          featureType: 'road',
          elementType: 'labels.text.fill',
          stylers: [{color: '#919bbb'}]
        },
        {
          featureType: 'road.highway',
          elementType: 'geometry',
          stylers: [{color: '#d1d9f0'}]
        },
        {
          featureType: 'road.highway',
          elementType: 'geometry.stroke',
          stylers: [{color: '#919bbb'}]
        },
        {
          featureType: 'road.highway',
          elementType: 'labels.text.fill',
          stylers: [{color: '#000'}]
        },
        {
          featureType: 'transit',
          elementType: 'geometry',
          stylers: [{color: '#919bbb'}]
        },
        {
          featureType: 'transit.station',
          elementType: 'labels.text.fill',
          stylers: [{color: '#919bbb'}]
        },
        {
          featureType: 'water',
          elementType: 'geometry',
          stylers: [{color: '#dee3f4'}]
        },
        {
          featureType: 'water',
          elementType: 'labels.text.fill',
          stylers: [{color: '#919bbb'}]
        },
        {
          featureType: 'water',
          elementType: 'labels.text.stroke',
          stylers: [{color: '#f705dd'}]
        }
      ]
    };
  }

  function getMarker(props) {
    return '<div class="marker-box"><p class="ttl"><a href="' + props.content.url + '">' + props.content.title + '</a></p><div class="des-marker"><div class="location"><div class="city">'+ props.content.city +'</div><div class="wr-date"><div class="date">'+ props.content.date +'</div><div class="year">'+ props.content.year +'</div></div></div><div class="wr-btn"><a href="'+ props.content.link +'" class="btn" target="_blank">GET Tickets</a></div></div></div>';
  }
}