@if(count($reviews = $product->getReviews()) >0)
    <table class="table table-responsive">
        <tr>
            <th>Tên</th>
            <th>Đánh giá</th>
            <th>Bình luận</th>
        </tr>

        @foreach($reviews as $review)

            <tr>
                <td>{{$review->user->full_name }} </td>
                <td>{{ $review->star }}</td>
                <td>{{ $review->comment }}</td>
            </tr>
        @endforeach
    </table>
@endif