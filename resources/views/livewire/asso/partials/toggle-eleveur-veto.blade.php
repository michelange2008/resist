<div class="flex flex-row gap-3 my-3">

    <img class="w-8 brightness-50 invert cursor-pointer" 
        src="{{ url('storage/img/eleveur.svg')}}"
        title="{{ __( 'asso.clicShowEleveur' ) }}"
        x-show="!showEleveur" 
        x-on:click="showEleveur=true, showVeto=false"/>

    <img class="w-8 invert cursor-pointer" 
        src="{{ url('storage/img/eleveur.svg')}}" 
        x-show="showEleveur"
        x-on:click="showEleveur=false"/>
    
    <img class="w-8 brightness-50 invert cursor-pointer"
        src="{{ url('storage/img/veto.svg')}}" 
        title="{{ __( 'asso.clicShowVeto' ) }}"
        x-show="!showVeto"
        x-on:click="showVeto=true, showEleveur=false"/>

    <img class="w-8 invert cursor-pointer"
        src="{{ url('storage/img/veto.svg')}}"
        x-show="showVeto"
        x-on:click="showVeto=false"/>

</div>