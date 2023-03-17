@extends('layout')
@section('title') Покупка билета @endsection
@section('main_content')

<div class="container">
	<br>
<center>
	<h1>{{$seance->Movies->first()->name}} - {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $seance->seanceDate)->format('d.m.Y h:i')}}</h1>
		<div class="screen-ui">
			<div id="screen">

			</div>
			
			<table class="table" id="table-screen">
				<!-- <thead id="screen-head">
					<tr>
						
		    		</tr>
		    	</thead> -->
		    	<tbody id="screen-body">
                @for ($i = 1; $i <= $seance->Halls->first()->countRows; $i++)
                <tr id='table-screen-row'>
                    @for ($j = 1; $j <= $seance->Halls->first()->countColumns; $j++)
                        <td>
							@if($i == 5 && $j >= 5 && $j <= 12)
                            <img src="https://sun9-22.userapi.com/impg/vILdjT9oDMVH5IrpedXezCY0Bb98tneHuRfjMg/TtmzCOL8xfA.jpg?size=19x19&quality=96&sign=2551c3bfd1f95d2eb5e9035fa120a1d1&type=album" height="20" width="20"></img>
							@else
							<img src="https://sun4-10.userapi.com/impg/xG46m3uEn0E_Xo5mVX3I2dmDwcz_siORFfmg2g/g2K4vFS6XC4.jpg?size=19x19&quality=96&sign=b316eb8c3bb9ce372a23c7c1eded24de&type=album" height="20" width="20"></img>
							@endif
                        </td>		
                    @endfor
                </tr>
                @endfor
                    
		    	</tbody>
			</table>
			</div>
					
		</div>
	</body>
</center>
</div>
@endsection
<style scoped>
#screen{
    width:70%;
    border-bottom: 50px solid gray;
	border-left: 75px solid transparent;
	border-right: 75px solid transparent;
}
</style>

