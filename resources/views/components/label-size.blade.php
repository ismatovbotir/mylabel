<svg width="{{ $w }}mm" height="{{ $h }}mm"
     viewBox="0 0 {{ $w }} {{ $h }}"
     xmlns="http://www.w3.org/2000/svg">

    <!-- yellow background -->
    <rect width="{{ $w }}" height="{{ $h }}" fill="#FFD500"/>

    <!-- white label -->
    <rect x="{{ $padding }}" y="{{ $padding }}"
          width="{{ $w - 2*$padding }}"
          height="{{ $h - 2*$padding }}"
          rx="{{ $radius }}" ry="{{ $radius }}"
          fill="#FFFFFF"/>

    <!-- centered size text -->
    <text x="{{ $w/2 }}" y="{{ $h/2 }}"
          text-anchor="middle"
          dominant-baseline="middle"
          font-size=".7rem"
          font-weight="700"
          fill="grey">
        {{ $w }} × {{ $h }} mm
    </text>
</svg>
