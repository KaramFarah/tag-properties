@push('scripts')
    {{-- delete photos --}}
    <script>
        $(document).ready(function() {
            $('.delete-image').on('click', function(event) {
                swal.fire({
                        title: "Are you sure?",
                        text: "You'r About To Delete This Record",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#808080",
                        confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let delete_url = $(this).attr('data-value')
                        let liId = $(this).attr('parent-id')
                        $.ajax({
                            type: "DELETE",
                            url: delete_url,
                            success: function(response) {
                                console.log(response.data)
                                $('#' + liId).remove();
                            },
                            error: function (request, status, error) {
                                alert('Error!')
                                console.log("request: "+request.toJSON())
                                console.log("status: "+status)
                                console.log("error: "+error)
                            }
                        });
                        event.preventDefault();
                            swal.fire({
                                title: "Deleted!",
                                text: "Your Record has been deleted.",
                                icon: "success"
                            });
                        }
                    });
                return false;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#remove-media').on('click', function(event) {
                var media_url = $(this).attr('data-value')
                $.ajax({
                    type: "DELETE",
                    url: media_url,
                    success: function(response) {
                        console.log(response.data)
                        alert('Removed')
                        //developer_name.val('')
                    },
                    error: function (request, status, error) {
                        alert('Error!')
                        console.log("request: "+request.toJSON())
                        console.log("status: "+status)
                        console.log("error: "+error)
                    }
                });
                event.preventDefault();
                return false;
            });
        });
    </script>

    {{-- delete Floors --}}
    <script>
        $(document).ready(function() {
            $('.delete-floor').on('click', function(event) {
                swal.fire({
                        title: "Are you sure?",
                        text: "You'r About To Delete This Record",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#808080",
                        confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                            let delete_url = $(this).attr('data-value')
                            let liId = $(this).attr('parent-id')
                            $.ajax({
                                type: "DELETE",
                                url: delete_url,
                                success: function(response) {
                                    console.log(response.data)
                                    $('#' + liId).remove();
                                    console.log(delete_url)
                                    console.log(liId)
                                    //developer_name.val('')
                                },
                                error: function (request, status, error) {
                                    alert('Error!')
                                    console.log(delete_url)
                                    console.log(liId)
                                    console.log("request: "+request.toJSON())
                                    console.log("status: "+status)
                                    console.log("error: "+error)
                                }
                            });
                            event.preventDefault();
                            swal.fire({
                                title: "Deleted!",
                                text: "Your Record has been deleted.",
                                icon: "success"
                            });
                        }
                    });
                return false;
            });
        });
    </script>

    {{-- delete Places --}}
    <script>
        $(document).ready(function() {
            $('.delete-place').on('click', function(event) {
                swal.fire({
                        title: "Are you sure?",
                        text: "You'r About To Delete This Record",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#808080",
                        confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let delete_url = $(this).attr('data-value')
                        let liId = $(this).attr('parent-id')
                        $.ajax({
                            type: "DELETE",
                            url: delete_url,
                            success: function(response) {
                                console.log(response.data)
                                $('#' + liId).remove();
                                //developer_name.val('')
                            },
                            error: function (request, status, error) {
                                alert('Error!')
                                console.log("request: "+request.toJSON())
                                console.log("status: "+status)
                                console.log("error: "+error)
                            }
                        });
                        event.preventDefault();
                            swal.fire({
                                title: "Deleted!",
                                text: "Your Record has been deleted.",
                                icon: "success"
                            });
                        }
                    });
                return false;
            });
        });
    </script>
    
    {{-- add floors update code --}}
    <script>
            $(document).ready(function() {
                let myDiv = document.getElementById("formContainer");
                let loop_index = myDiv.childElementCount;
                let newFloor = document.getElementById("newFloorPlan").firstElementChild;
                let apiRoute = "{{ route('api.floor-plans') }}" + "?loop_index=" + loop_index;
     
    
    
                $('#addfloor').click(function() {
                    $.ajax({
                            type: "GET",
                            url: apiRoute,
                            success: function(response) {
                                $('#formContainer').append(response);
                                loop_index++;
                                apiRoute = "{{ route('api.floor-plans') }}" + "?loop_index=" + loop_index;
                                // console.log(apiRoute)
                            },
                            error: function (response, request, status, error) {
                                console.log(response.responseText)
                                alert('Error!')
                                console.log("request: "+request.toJSON())
                                console.log("status: "+status)
                                console.log("error: "+error)
                            }
                    });                            
                });
            });
            
            $(document).on('click' , '.remove-floor' , function(){
                // $(this).parent().remove();
                swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#808080",
                            confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('.Container').remove();
                        swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                                });
                            }
                        });
            });
    </script>

    {{-- add places updated code --}}
    <script>
            $(document).ready(function() {
                let myDiv = document.getElementById("placeContainer");
                let loop_index =  myDiv.childElementCount;
                let newPlace = document.getElementById("newNearbyPlace").firstElementChild;
                let apiRoute = "{{ route('api.nearby-places') }}" + "?loop_index=" + loop_index;
     
    
    
                $('#addNewPlace').click(function() {
                    $.ajax({
                            type: "GET",
                            url: apiRoute,
                            success: function(response) {
                                $('#placeContainer').append(response);
                                loop_index++;
                                apiRoute = "{{ route('api.nearby-places') }}" + "?loop_index=" + loop_index;
                                // console.log(apiRoute)
                            },
                            error: function (response, request, status, error) {
                                console.log(response.responseText)
                                alert('Error!')
                                console.log("request: "+request.toJSON())
                                console.log("status: "+status)
                                console.log("error: "+error)
                            }
                        });                            
                });
            });
            $(document).on('click' , '.remove-place' , function(){
                // $(this).parent().remove();
                swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('.Container').remove();
                        swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                                });
                            }
                        });
            });
    </script>

    {{-- map integration --}}
    <script>
        var initialplace = document.getElementById('location').value;
        let coordinates = initialplace.split(';')
        var map = L.map('map').setView([coordinates[0], coordinates[1]], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([coordinates[0], coordinates[1]]).addTo(map)
        .bindPopup('{{$unit->name ?? 'Welcome To TAG Properties. You Can Choose Your Property Location Here.'}}')
        .openPopup();

        // var popup = L.popup();

        function onMapClick(e) {
            marker
                .setLatLng(e.latlng)
                // .bindPopup('New Location Was Selected!')
                // .openPopup();

            let result = `${e.latlng.lat};${e.latlng.lng}`;
            document.getElementById('location').value = result;
            console.log(result);
        }

        map.on('click', onMapClick);
    </script>
@endpush