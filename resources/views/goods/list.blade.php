@foreach($data as $k=>$v)
<div>
	{{ $v->goods_id }}
	{{ $v->goods_sn }}
	{{ $v->goods_name }}
</div>
<hr>
@endforeach