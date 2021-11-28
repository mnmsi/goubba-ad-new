<style>

    .phone {
        /* display: none; */
        border: 40px solid #ddd;
        border-width: 55px 7px;
        border-radius: 40px;
        /* margin: 50px auto; */
        overflow: hidden;
        transition: all 0.5s ease;
        height: 500px;
        width: 250px;
    }

    /* a:hover + .phone,.phone:hover{
        display: block;
        position: relative;
        z-index: 100;
    } */

    .phone iframe {
        border: 0;
        width: 100%;
        height: 100%;
    }
    /*Different Perspectives*/

    .phone.view_3 {
        transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
        box-shadow: 0px 3px 0 #BBB, 0px 4px 0 #BBB, 0px 5px 0 #BBB, 0px 7px 0 #BBB, 0px 10px 20px #666;
    }

    .modal-dialog {
        max-height: 500px;
        max-width: 250px;
    }

    .modal-content {
        border-radius: 40px!important;
    }
</style>


<!-- PREVIEW MODAL -->
<div id="previewModal" class="modal fade">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="phone view_3" id="phone">
                {{-- src="{{ url('previewShow') }}" --}}
                {{-- $('#phone-iframe').attr('src', '{{ url('previewShow') }}'); --}}
                <iframe id="phone-iframe"></iframe>
            </div>
		</div>
	</div><!-- MODAL-DIALOG -->
</div>
<!-- PREVIEW MODAL CLOSED -->
