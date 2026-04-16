<div id="map" style="height: 400px;"></div>

<script>
    // 1. Map Initialize karein
    var map = L.map('map').setView([{{ $order->lat }}, {{ $order->lng }}], 15);
    
    // 2. Tile Layer add karein (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // 3. Initial Marker banayein
    var marker = L.marker([{{ $order->lat }}, {{ $order->lng }}]).addTo(map);

    // 4. LIVE TRACKING LOGIC (Laravel Echo)
    // Ye tabhi chalega jab event broadcast hoga
    window.Echo.channel('order.{{ $order->id }}')
        .listen('OrderLocationUpdated', (e) => {
            console.log('New Location Received:', e);
            
            // Marker ko move karein
            var newLatLng = new L.LatLng(e.latitude, e.longitude);
            marker.setLatLng(newLatLng);
            
            // Map ko smooth move karne ke liye (Optional)
            map.panTo(newLatLng);
        });
</script>