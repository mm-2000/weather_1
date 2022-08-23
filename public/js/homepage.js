var modalFlag = false

function initMap(){
    var map = new google.maps.Map(
      document.getElementById("map"),
      {
        zoom: 4,
        center: { lat: -25.363882, lng: 131.044922 },
      }
    );
  
    map.addListener("click", (e) => {
      clickHandle(e.latLng, map);
    });
  }


function clickHandle(e, map){
    if(modalFlag === false){
        modalFlag = true
        var data = e.toJSON()
        $.post( "/api/weather/get", data)
        .done(function( data ) {
            $('#map').append(createModal(data))
            $('#modal').show()
            $('#closeModalButton').on('click', function(){
                $('#modal').hide()
                $('#modal').remove()
                modalFlag = false
            })
        });
    }
}


function createModal(data){

    return `
    <div class="modal" tabindex="-1" id="modal" style="display:true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Weather in ` + data.name + `</h5>
        </div>
        <div class="modal-body">
            <h4>Place: ` + data.name + `</h4>
            <p>Weather Description: ` + data.description + `</p>
            <p>Temperature: ` + data.temp + `</p>
            <p>Min Temperature: ` + data.temp_min + `</p>
            <p>Max Temperature: ` + data.temp_max + `</p>
            <p>Wind Speed: ` + data.wind_speed + `</p>
            <p>Clouds: ` + data.clouds + `</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="closeModalButton">Close</button>
        </div>
        </div>
    </div>
    </div>`
}