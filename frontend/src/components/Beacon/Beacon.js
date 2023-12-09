import React from 'react';
import { Circle, Marker } from '@react-google-maps/api';
import BeaconInfoWindow from './InfoWindow/BeaconInfoWindow.js';

const Beacon = ({ id, activeBeacon, onBeaconClick, beacon }) => {
  const circle = {
    center: {
        lat: beacon.latitude,
        lng: beacon.longitude
      },
    radius: 250, // Radius in meters 
    options: {
      fillColor: '#FF0000', 
      strokeColor: '#0000FF', 
      strokeOpacity: 0.8, 
      strokeWeight: 2, 
    },
  };

  const toggleDisplayBeacon = () => {
    onBeaconClick(id);
  }

  return (
    <>
    <Marker 
        position={{ lat: beacon.latitude, lng: beacon.longitude }} 
        className="rounded-full bg-black"
        onClick={toggleDisplayBeacon}
        icon={{
          url: beacon.game_image,
          path: google.maps.SymbolPath.CIRCLE,
          scaledSize: new window.google.maps.Size(65, 65) // size of the icon
        }}
      />
      {activeBeacon === id && (
        <div className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
          <div className="w-screen max-w-[30rem]">
            <BeaconInfoWindow {...beacon} onClose={toggleDisplayBeacon} id={id}/>
          </div>
        </div>
      )}
    </>
  );
};

Beacon.defaultProps = {
    beaconInfo: BeaconInfoWindow.defaultProps,
    circleLat: 40.1,
    circleLng: -75.2
};

export default Beacon;