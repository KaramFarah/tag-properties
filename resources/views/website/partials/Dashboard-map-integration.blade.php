@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection
@push('scripts')
    <script>
        var initialplace = document.getElementById('location').value;
        let coordinates = initialplace.split(';')
        var map = L.map('map').setView([coordinates[0], coordinates[1]], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([coordinates[0], coordinates[1]]).addTo(map)
        .bindPopup('{{$project->name ?? 'Welcome To TAG Properties. You Can Choose Your Project Location Here.'}}')
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