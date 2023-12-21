<tr id="item{{ $item->product_id }}">
    <td>{{ $item->product_name }}</td>
    <td>1</td>
    <td>{{ $item->selling_price }}</td>
    <td>{{ $item->selling_price }}</td>
    <td>
        <button class="btn btn-danger btn-sm" onclick="removeProduct({{ $item->product_id }})">Remove</button>
    </td>
</tr>