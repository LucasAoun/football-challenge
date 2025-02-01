@extends('template')
@section('title', 'Página Inicial')

@section('content')
<div class="container-fluid">
    <h2>Bem-vindo ao APP FOOTBALL</h2>
    @if(empty($competition_matches))
        <h3>Proximos jogos</h3>
    @else
        <h3>Jogos</h3>
    @endif
    
    <div class="form-search">
        <form action="{{route('football.index')}}">
            <input class="form-control search" type="text" name="search" placeholder="Digite o nome ou a sigla da competição" aria-label="default input example" value="{{$search ?? ''}}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
    <br>
    @if(empty($competition_matches))
        <div class="next-games">
            @foreach($matches['matches'] as $match)
                <div class="match-container">
                    <div class="homeTeam">
                        <span>{{$match['homeTeam']['name']}}</span><br><br>
                        <img src="{{$match['homeTeam']['crest']}}" alt="">
                    </div>
                    <div class="versus">
                        <span class="area" style="font-size:12px;">{{ $match['competition']['name'] ?? 'Local não disponível' }}</span>
                        <h1>X</h1>
                        <div class="match-info">
                            <span class="area">{{ $match['area']['name'] ?? 'Local não disponível' }}</span>
                            <span class="date-time">{{ $match['utcDate'] ?? 'Data não disponível' }}</span>
                        </div>
                    </div>
                    <div class="awayTeam">
                        <span>{{$match['awayTeam']['name']}}</span><br><br>
                        <img src="{{$match['awayTeam']['crest']}}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if(isset($competition_matches) && isset($competition_matches['error']))
        <h3>{{$competition_matches['error']}}</h3>
    @else
    @if(!empty($competition_matches))
        <div class="games-container">
            <div class="games-column">
                <h3>Jogos Finalizados</h3>
                @if(isset($competition_matches['last_matches']))
                    <div class="games-list">
                        @foreach($competition_matches['last_matches'] as $match)
                            <div class="match-container">
                                <div class="homeTeam">
                                    <span>{{$match['homeTeam']['name']}}</span><br><br>
                                    <img src="{{$match['homeTeam']['crest']}}" alt="">
                                </div>
                                <div class="versus">
                                    <span class="area" style="font-size:12px;">{{ $match['competition']['name'] ?? 'Local não disponível' }}</span>
                                    <h1>{{$match['score']['fullTime']['home']}} - {{$match['score']['fullTime']['away']}}</h1>
                                    <div class="match-info">
                                        <span class="area">{{ $match['area']['name'] ?? 'Local não disponível' }}</span>
                                        <span class="date-time">{{ $match['utcDate'] ?? 'Data não disponível' }}</span>
                                    </div>
                                </div>
                                <div class="awayTeam">
                                    <span>{{$match['awayTeam']['name']}}</span><br><br>
                                    <img src="{{$match['awayTeam']['crest']}}" alt="">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="games-column">
                <h3>Próximos Jogos</h3>
                <div class="games-list">
                    @if(isset($competition_matches['next_matches']) && !empty($competition_matches['next_matches']))
                        @foreach($competition_matches['next_matches'] as $match)
                            <div class="match-container">
                                <div class="homeTeam">
                                    <span>{{$match['homeTeam']['name']}}</span><br><br>
                                    <img src="{{$match['homeTeam']['crest']}}" alt="">
                                </div>
                                <div class="versus">
                                    <span class="area" style="font-size:12px;">{{ $match['competition']['name'] ?? 'Local não disponível' }}</span>
                                    <h1>X</h1>
                                    <div class="match-info">
                                        <span class="area">{{ $match['area']['name'] ?? 'Local não disponível' }}</span>
                                        <span class="date-time">{{ $match['utcDate'] ?? 'Data não disponível' }}</span>
                                    </div>
                                </div>
                                <div class="awayTeam">
                                    <span>{{$match['awayTeam']['name']}}</span><br><br>
                                    <img src="{{$match['awayTeam']['crest']}}" alt="">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endif
    @endif
</div>
@endsection