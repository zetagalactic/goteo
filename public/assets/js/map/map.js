/*
@licstart  The following is the entire license notice for the
JavaScript code in this page.

Copyright (C) 2010  Goteo Foundation

The JavaScript code in this page is free software: you can
redistribute it and/or modify it under the terms of the GNU
General Public License (GNU GPL) as published by the Free Software
Foundation, either version 3 of the License, or (at your option)
any later version.  The code is distributed WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS
FOR A PARTICULAR PURPOSE.  See the GNU GPL for more details.

As additional permission under GNU GPL version 3 section 7, you
may distribute non-source (e.g., minimized or compacted) forms of
that code without the copy of the GNU GPL normally required by
section 4, provided you include this license notice and a URL
through which recipients can access the Corresponding Source.


@licend  The above is the entire license notice
for the JavaScript code in this page.
*/

$(function(){
  

  var projectIcon = L.icon({
    iconUrl: '/assets/img/map/pin-project.svg',
    iconSize:     [38, 95] // size of the icon
});

var workshopIcon = L.icon({
  iconUrl: '/assets/img/map/pin-workshop.svg',
  iconSize:     [38, 95] // size of the icon
});

  // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  // }).addTo(map);
  
  var channel = $('#map').data('channel');
  if (channel) {
    $.ajax({
      url: '/api/map/channel/' + channel,
      type: 'GET'
    }).done(function(data) {
      var latlngs = [];
      var projects = data.projects;
      var workshops = data.workshops;
      var project_markers = L.markerClusterGroup();
      projects.forEach(function(project){

        if (project.project_location.latitude && project.project_location.longitude) {
          latlngs.push([project.project_location.latitude, project.project_location.longitude]);
          project_markers.addLayer(L.marker([project.project_location.latitude, 
            project.project_location.longitude], { icon: projectIcon }).bindPopup(project.popup));
        }
      });
        
      var workshop_markers = L.markerClusterGroup();
      workshops.forEach(function(workshop){
      if (workshop.workshop_location.latitude && workshop.workshop_location.longitude) {
        latlngs.push([workshop.workshop_location.latitude, workshop.workshop_location.longitude]);
        workshop_markers.addLayer(L.marker([workshop.workshop_location.latitude, 
          workshop.workshop_location.longitude], { icon: workshopIcon }).bindPopup(project.popup));
        }
      });
        
      var projects_layer = L.layerGroup(project_markers);
      var workshops_layer = L.layerGroup(workshop_markers);
      var latLngBounds = L.latLngBounds(latlngs);
      var map = L.map('map', {
        fullscreenControl: true,
        center: latLngBounds.getCenter(),
        zoom: 5
      });
      L.tileLayer($('#map').data('tile-layer'), {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
  
      map.addLayer(project_markers);
      map.addLayer(workshop_markers);
      // L.control.layers({'projects': projects_layer, 'workshops': workshops_layer}).addTo(map);
      // map.setView(latLngBounds.getCenter(), 5);
    });
  }
});