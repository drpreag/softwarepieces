<?php

use Illuminate\Database\Seeder;
use App\News;
use Carbon\Carbon as Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::insert ([
        	'id'=>1, 
			'title'=>'Understanding How a Neural Network Works Using R',
        	'url'=>'http://opensourceforu.com/2017/11/understanding-neural-network-works-using-r/?utm_source=feedburner&utm_medium=email&utm_campaign=Feed%3A+LinuxForYou+%28OpenSourceForYou+%29', 
        	'imgurl'=>'https://i2.wp.com/opensourceforu.com/wp-content/uploads/2017/10/Neural-Network-Data-Mining-illustration_October-2017.jpg?resize=850%2C468',
        	'post'=>'<p>In the simplest of terms, a <strong>neural network</strong> is a computer system modelled on the human nervous system.</p>
<p>It is widely used in machine learning technology. R is an open source programming language, which is mostly used by statisticians and data miners. It greatly supports machine learning, for which it has many packages. The neural network is the most widely used machine learning technology available today. Its algorithm mimics the functioning of the human brain to train a computational network to identify the inherent patterns of the data under investigation. There are several variations of this computational network to process data, but the most common is the feedforward-backpropagation configuration. Many tools are available for its implementation, but most of them are expensive and proprietary. There are at least 30 different packages of open source neural network software available, and of them, R, with its rich neural network packages, is much ahead.</p>',
			'category'=>10, 
        	'creator'=>1, 
        	'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        News::insert ([
        	'id'=>2, 
			'title'=>'Black Friday 2017: All the best deals, sales, and ads on laptops, desktop PCs',        	
        	'url'=>'http://www.zdnet.com/article/black-friday-2017-all-the-best-deals-sales-and-ads-on-laptops-desktop-pcs/?loc=newsletter_large_thumb_featured&ftag=TRE-03-10aaa6b&bhid=27412513388814617413479181125421', 
        	'imgurl'=>'',
        	'post'=>'<p>Looking for one place to find the best Black Friday deals kicking off the 2017 holiday shopping season?</p>
<p>Search no further, as this article collects all of the Black Friday sales from all of the Black Friday ads that have been posted online in the past few weeks. If you\' re shopping for a new laptop, desktop PC, or even an iPad, we have the doorbusters, specials, and discounts from retailers like Best Buy, Target, and Walmart, and manufacturers like Dell, HP, and Samsung to help you make your purchasing decision. Be sure to bookmark this page, as we will update the deals as Black Friday wraps up and Cyber Monday ramps up.</p>',        	
			'category'=>13, 
        	'creator'=>1, 
        	'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        News::insert ([
        	'id'=>3, 
			'title'=>'What’s the Difference between Deep Learning, Machine Learning and AI?',        	
        	'url'=>'http://opensourceforu.com/2017/11/whats-difference-deep-learning-machine-learning-ai/?utm_source=feedburner&utm_medium=email&utm_campaign=Feed%3A+LinuxForYou+%28OpenSourceForYou+%29', 
        	'imgurl'=>'',
        	'post'=>'<p>AI, deep learning and machine learning are often mistaken for each other. Take a look at how they differ in this interesting article.<br /><br />From being dismissed as science fiction to becoming an integral part of multiple, wildly popular movie series, especially the one starring Arnold Schwarzenegger, artificial intelligence has been a part of our life for longer than we realise. The idea of machines that can think has widely been attributed to a British mathematician and WWII code-breaker, Alan Turing. In fact, the Turing Test, often used for benchmarking the &lsquo;intelligence&rsquo; in artificial intelligence, is an interesting process in which AI has to convince a human, through a conversation, that it is not a robot. There have been a number of other tests developed to verify how evolved AI is, including Goertzel&rsquo;s Coffee Test and Nilsson&rsquo;s Employment Test that compare a robot&rsquo;s performance in different human tasks.</p>',        	
			'category'=>12, 
        	'creator'=>1, 
        	'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        News::insert ([
        	'id'=>4, 
			'title'=>'Self-driving bus crashes two hours after launch in Las Vegas',        	
        	'url'=>'http://www.zdnet.com/article/self-driving-bus-crashes-two-hours-after-launch-in-las-vegas/?loc=newsletter_large_thumb_featured&ftag=TRE-03-10aaa6b&bhid=27412513388814617413479181125421', 
        	'imgurl'=>'https://zdnet3.cbsistatic.com/hub/i/r/2017/11/09/c2bbd996-1fcc-466b-8475-17597446f256/resize/770xauto/2af907192beab9f95108ffa1b084e11e/vegasshuttle.jpg',
        	'post'=>'<p>A driverless shuttle bus crashed less than two hours after it was launched in Las Vegas on Wednesday.</p>
<p>The city\'s officials had been hosting an unveiling ceremony for the bus, described as the US\' first self-driving shuttle pilot project geared towards the public, before it crashed with a semi-truck.</p>',        	
			'category'=>12, 
        	'creator'=>1, 
        	'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        News::insert ([
        	'id'=>5, 
			'title'=>'Regular Expressions in Programming Languages: PHP and the Web',        	
        	'url'=>'http://opensourceforu.com/2017/11/regular-expressions-in-programming-languages-php-and-the-web/?utm_source=feedburner&utm_medium=email&utm_campaign=Feed%3A+LinuxForYou+%28OpenSourceForYou+%29', 
        	'imgurl'=>'https://i0.wp.com/opensourceforu.com/wp-content/uploads/2017/10/PHP-Development.jpg?resize=850%2C649',
        	'post'=>'<p>This is the fourth article in the series on regular expressions. In the past three articles, we have discussed regular expression styles in Python, Perl and C++. Now, we will explore regular expressions in PHP.<br /><br />Let me first introduce the PHP environment before discussing regular expressions in it. This basic introduction of PHP will be sufficient even for non-practitioners to try out the regular expressions discussed here. Even if you&rsquo;re not interested in PHP, the regular expressions discussed here will definitely interest you.</p>',        	
			'category'=>8, 
        	'creator'=>1, 
        	'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        News::insert ([
        	'id'=>6, 
			'title'=>'Google: Our hunt for hackers reveals phishing is far deadlier than data breaches',        	
        	'url'=>'http://www.zdnet.com/article/google-our-hunt-for-hackers-reveals-phishing-is-far-deadlier-than-data-breaches/?loc=newsletter_large_thumb_featured&ftag=TRE-03-10aaa6b&bhid=27412513388814617413479181125421', 
        	'imgurl'=>'https://zdnet4.cbsistatic.com/hub/i/r/2017/11/10/b3a21611-1ddb-4ddc-a706-fa0b42fed227/resize/770xauto/f34d6a88ba3bbd8f901926ff301e87e1/googleidtheft.png',
        	'post'=>'<p>Google has released the results of a year-long investigation into Gmail account hijacking, which finds that phishing is far riskier for users than data breaches, because of the additional information phishers collect.<br /><br />Hardly a week goes by without a new data breach being discovered, exposing victims to account hijacking if they used the same username and password on multiple online accounts.<br /><br />While data breaches are bad news for internet users, Google\'s study finds that phishing is a much more dangerous threat to its users in terms of account hijacking.</p>',        	
			'category'=>14, 
        	'creator'=>1, 
        	'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        News::insert ([
        	'id'=>7, 
			'title'=>'Snappy Ubuntu Core for Embedded and IoT Devices',        	
        	'url'=>'http://opensourceforu.com/2017/11/snappy-ubuntu-core-embedded-iot-devices/?utm_source=feedburner&utm_medium=email&utm_campaign=Feed%3A+LinuxForYou+%28OpenSourceForYou+%29', 
        	'imgurl'=>'https://i1.wp.com/opensourceforu.com/wp-content/uploads/2017/10/Ubuntu-Snappy-embedded-with-laptop.jpg?resize=850%2C490',
        	'post'=>'<p>Ubuntu Core is a minimalistic version of Ubuntu. It is lightweight and is designed for use with embedded systems and IoT devices. Snaps are universal Linux packages, which are faster to install, easier to create, and safe to run and work on multiple distributions.<br /><br />The biggest challenge in delivering Linux applications is dependency resolution. As distributions update underlying libraries frequently, it is not always possible to offer application binaries as offline archives. One can&rsquo;t think of downgrading an application if underlying packages are upgraded, which are in turn required by some more applications. Also, it&rsquo;s not possible to keep multiple versions of the same library in view of different applications. Ubuntu Core has a solution for all this complexity, whereby a single device can host multiple isolated applications with their own dependencies.</p>',        	
			'category'=>4, 
        	'creator'=>1, 
        	'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

    }
}
