@extends('layout.app')
@section('title', '')
@section('content')


<div class="breadcrumbs1_wrapper">
    <div class="container">
      <div class="title1"><h1>DALLAS HISTORY</h1></div>
    </div>
</div>
<section class="bg-light">
    <div class="container">
        <div class="section-heading">
            <div class="px-10 pa-5 v-card v-sheet ">
                <div class="row flex align-center dallas-history-section">
                    <div class="col-sm-3 col-12">
                        <img src="{{ url('images/dallas_history/bigtex.jpg')}}" style="width:100%;"/>
                    </div>
                    <div class="col-sm-8 col-12"> 
                        Dallas is proud of its western heritage and runs away from the traditional image of a deserted western city, which tourists hope to find in Texas, south of the United States. Luxurious, full of cars and shopping malls, Dallas is a city rich in tall buildings and wide avenues. Dallas cowboys walk around displaying their boots and belts and contrasting the modernity of shopping centers with the world of cattle and oil. Preceded by thousands of years of varying cultures, the Caddo people inhabited the Dallas area before Spanish colonists claimed the territory of Texas in the 18th century as a part of the Viceroyalty of New Spain. Later, France also claimed the area but never established much settlement. In all, six flags have flown over the area preceding and during the city's history: those of France, Spain, and Mexico, the flag of the Republic of Texas, the Confederate flag, and the flag of the United States of America. 
                    </div>
                </div>
                <div class="row flex align-center dallas-history-section">
                    <div class="col-sm-8 col-12">
                        In 1819, the Adams-Onís Treaty between the United States and Spain defined the Red River as the northern boundary of New Spain, officially placing the future location of Dallas well within Spanish territory. The area remained under Spanish rule until 1821, when Mexico declared independence from Spain, and the area was considered part of the Mexican state of Coahuila y Tejas. In 1836, Texians, with a majority of Anglo-American settlers, gained independence from Mexico and formed the Republic of Texas. 
                    </div>
                    <div class="col-sm-4 col-12">
                        <img src="{{ url('images/dallas_history/flag_texas.jpg')}}" style="width:100%;"/>
                    </div>
                </div>
                <div class="row flex align-center dallas-history-section">
                    <div class="col-sm-4 col-12">
                        <img src="{{ url('images/dallas_history/dallas-city.jpg')}}" style="width:100%;"/>
                    </div>
                    <div class="col-sm-8 col-12"> 
                        Three years after Texas achieved independence, John Neely Bryan surveyed the area around present-day Dallas. In 1839, accompanied by his dog and a Cherokee he called Ned, he planted a stake in the ground on a bluff located near three forks of the Trinity River and left. Two years later, in 1841, he returned to establish a permanent settlement named Dallas. The origin of the name is uncertain. The official historical marker states it was named after Vice President George M. Dallas of Philadelphia, Pennsylvania. However, this is disputed. Other potential theories for the origin include his brother, Commodore Alexander James Dallas, as well as brothers Walter R. Dallas or James R. Dallas. A further theory gives the ultimate origin as the village of Dallas, Moray, Scotland, similar to the way Houston, Texas was named after Sam Houston whose ancestors came from the Scottish village of Houston, Renfrewshire. The Republic of Texas was annexed by the United States in 1845 and Dallas County was established the following year. Dallas was formally incorporated as a city on February 2, 1856. In the mid-1800s, a group of French Socialists established La Réunion, a short-lived community, along the Trinity River in what is now West Dallas. 
                    </div>
                </div>
                <div class="row flex align-center dallas-history-section">
                    <div class="col-sm-8 col-12"> With the construction of railroads, Dallas became a business and trading center and was booming by the end of the 19th century. 
                        It became an industrial city, attracting workers from Texas, the South, and the Midwest. 
                        The Praetorian Building in Dallas of 15 stories, built in 1909, was the first skyscraper west of the Mississippi and the tallest building in Texas for some time. 
                        It marked the prominence of Dallas as a city. A racetrack for thoroughbreds was built and their owners established the Dallas Jockey Club. 
                        Trotters raced at a track in Fort Worth, where a similar drivers club was based. The rapid expansion of population increased competition for jobs and housing.
                    </div>
                    <div class="col-sm-4 col-12">
                        <img src="{{ url('images/dallas_history/State-Fair-of-Texas-auto-show.jpg')}}" style="width:100%;"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>


@endsection