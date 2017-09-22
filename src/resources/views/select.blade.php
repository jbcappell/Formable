<select id='{{$field}}' class='{$this->inputClass}' name='$field'>";

    @foreach($options as $key=>$value)
      <option value='{{$key}}' {{ ($key == $defaultValue ? ' selected' : null) }}> {{$value}}</option>
    @endforeach

</select>
