<datalist id="listSP">
    @foreach ($sanpham as $item)
        <select>
            <option value="{{ $item->ten_sp }}">
        </select>
    @endforeach
</datalist>