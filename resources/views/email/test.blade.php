    <div align = "center">
    <h3>{{$offre->titre_offre}}</h3>
    <p align="center">Cette offre est envoyee par : jobs@homsys.ma</p>
        <p align="center">Lien de l'offre {{$link}}</p>
        <h4>Description de l'offre</h4>
        <hr>
        <p align="justify">{{strip_tags($offre->description_offre)}}</p>
        <hr>
        <p><a href="www.homsys.ma">HOMSYS</a></p>

    </div>
