@extends('layouts.client')

@section('content')
<div id="global">
    <div class="home-intro">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p>
                        You are  browsing the best resource for <em>Online Education.</em>
                        <span>Just clear crisp and to the point content, nothing else.</span>
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="get-started">
                        <h1 class="head">||Tutorials Library||</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row featured-boxes">
            <div class="col-md-3">
                <div class="featured-box">
                    <h4>Java Technologies</h4>
                    <ul class="menu" id="java_technologies">
                        <li><a  href="/ant/index.htm" title="Learn Apache ANT">Learn Apache Ant</a></li>
                        <li><a  href="/apache_poi_word/index.htm" title="Learn Apache POI (Word)">Learn Apache POI (Word)</a></li>
                        <li><a  href="/apache_poi/index.htm" title="Learn Apache POI">Learn Apache POI</a></li>
                        <li><a  href="/awt/index.htm" title="Learn AWT">Learn AWT</a></li>
                        <li><a  href="/design_pattern/index.htm" title="Learn Design Patterns in Java">Learn Design Patterns</a></li>
                    </ul>
                    <h4>Digital Marketing</h4>
                        <ul class="menu" id="digital_marketing">
                        <li><a  href="/amazon_marketplace/index.htm" title="Learn Amazon Marketplace">Learn Amazon Marketplace</a></li>
                        <li><a  href="/ab_testing/index.htm" title="Learn A/B Testing">Learn A/B Testing</a></li>
                        <li><a  href="/content_marketing/index.htm" title="Content Marketing">Content Marketing</a></li>
                        <li><a  href="/conversion_rate_optimization/index.htm" title="Conversion Rate Optimization">Conversion Rate Optimization</a></li>
                        <li><a  href="/digital_marketing/index.htm" title="Learn Digital Marketing">Learn Digital Marketing</a></li>
                    </ul>
                    <h4>Databases</h4>
                        <ul class="menu" id="database_tutorials">
                        <li><a  href="/apache_presto/index.htm" title="Learn Apache Presto">Learn Apache Presto</a></li>
                        <li><a  href="/couchdb/index.htm" title="Learn CouchDB">Learn CouchDB</a></li>
                        <li><a  href="/db2/index.htm" title="Learn DB2">Learn DB2</a></li>
                        <li><a  href="/documentdb_sql/index.htm" title="Learn DocumentDB SQL">Learn DocumentDB SQL</a></li>
                        <li><a  href="/documentdb/index.htm" title="Learn DocumentDB">Learn DocumentDB</a></li>
                    </ul>
                    <h4>Sports</h4>
                    <ul class="menu" id="sports_tutorials">
                        <li><a  href="/american_football/index.htm" title="American Football">American Football</a></li>
                        <li><a  href="/archery/index.htm" title="Archery">Archery</a></li>
                        <li><a  href="/athletics/index.htm" title="Athletics">Athletics</a></li>
                        <li><a  href="/australian_football/index.htm" title="Australian Football">Australian Football</a></li>
                        <li><a  href="/badminton/index.htm" title="Badminton">Badminton</a></li>
                    </ul>
                    <h4>Monuments</h4>
                        <ul class="menu" id="famous_monuments">
                        <li><a  href="/golden_temple/index.htm" title="Golden Temple">Golden Temple</a></li>
                        <li><a  href="/gwalior_fort/index.htm" title="Gwalior Fort">Gwalior Fort</a></li>
                        <li><a  href="/jahanpanah_fort/index.htm" title="Jahanpanah  Fort">Jahanpanah Fort</a></li>
                        <li><a  href="/jagannath_temple/index.htm" title="Jagannath  Temple">Jagannath Temple</a></li>
                        <li><a  href="/jaigarh_fort/index.htm" title="Jaigarh  Fort">Jaigarh Fort</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="featured-box">
                    <h4>Programming</h4>
                    <ul class="menu" id="programming">
                        <li><a  href="/apex/index.htm" title="Learn Apex Programming">Learn Apex</a></li>
                        <li><a  href="/arduino/index.htm" title="Learn Arduino Programming">Learn Arduino</a></li>
                        <li><a  href="/assembly_programming/index.htm" title="Learn Assembly Programming">Learn Assembly</a></li>
                        <li><a  href="/awk/index.htm" title="Learn Awk Programming">Learn Awk</a></li>
                        <li><a  href="/c_standard_library/index.htm" title="C Standard Library">C Standard Library</a></li>
                    </ul>
                    <h4>Big Data &amp; Analytics</h4>
                    <ul class="menu" id="big_data">
                        <li><a  href="/advanced_excel_charts/index.htm" title="Learn Advanced Excel Charts">Advanced Excel Charts</a></li>
                        <li><a  href="/advanced_excel_functions/index.htm" title="Learn Advanced Excel Functions">Advanced Excel Functions</a></li>
                        <li><a  href="/apache_flume/index.htm" title="Learn Apache Flume">Learn Apache Flume</a></li>
                        <li><a  href="/apache_kafka/index.htm" title="Learn Apache Kafka">Learn Apache Kafka</a></li>
                        <li><a  href="/apache_pig/index.htm" title="Learn Apache Pig">Learn Apache Pig</a></li>
                    </ul>
                    <h4>Mainframe Development</h4>
                    <ul class="menu" id="mainfarme">
                        <li><a  href="/cics/index.htm" title="Learn CICS">Learn CICS</a></li>
                        <li><a  href="/cobol/index.htm" title="Learn COBOL">Learn COBOL</a></li>
                        <li><a  href="/db2/index.htm" title="Learn DB2">Learn DB2</a></li>
                        <li><a  href="/ims_db/index.htm" title="Learn IMS DB">Learn IMS DB</a></li>
                        <li><a  href="/jcl/index.htm" title="Learn JCL">Learn JCL</a></li>
                    </ul>
                    <h4>Microsoft Technologies</h4>
                    <ul class="menu" id="microsoft_technologies">
                        <li><a  href="/advanced_excel/index.htm" title="Learn Advanced Excel">Learn Advanced Excel</a></li>
                        <li><a  href="/asp.net_core/index.htm" title="Learn ASP.Net Core">Learn ASP.Net Core</a></li>
                        <li><a  href="/asp.net_mvc/index.htm" title="Learn ASP.Net MVC">Learn ASP.Net MVC</a></li>
                        <li><a  href="/asp.net_wp/index.htm" title="Learn ASP.Net WP">Learn ASP.Net WP</a></li>
                        <li><a  href="/asp.net/index.htm" title="Learn ASP.Net">Learn ASP.Net</a></li>
                    </ul>
                    <h4>Microsoft Technologies</h4>
                    <ul class="menu" id="microsoft_technologies">
                        <li><a  href="/advanced_excel/index.htm" title="Learn Advanced Excel">Learn Advanced Excel</a></li>
                        <li><a  href="/asp.net_core/index.htm" title="Learn ASP.Net Core">Learn ASP.Net Core</a></li>
                        <li><a  href="/asp.net_mvc/index.htm" title="Learn ASP.Net MVC">Learn ASP.Net MVC</a></li>
                        <li><a  href="/asp.net_wp/index.htm" title="Learn ASP.Net WP">Learn ASP.Net WP</a></li>
                        <li><a  href="/asp.net/index.htm" title="Learn ASP.Net">Learn ASP.Net</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="featured-box">
                    <h4>Web Development</h4>
                    <ul class="menu" id="web_development">
                        <li><a  href="/ajax/index.htm" title="Learn Ajax">Learn Ajax</a></li>
                        <li><a  href="/amazon_web_services/index.htm" title="Learn Amazon Web Services">Learn Amazon Web Services</a></li>
                        <li><a  href="/angular_material/index.htm" title="Learn Angular Material">Learn Angular Material</a></li>
                        <li><a  href="/angular2/index.htm" title="Learn Angular2">Learn Angular2</a></li>
                        <li><a  href="/angular2/index.htm" title="Learn Angular2">Learn Angular2</a></li>
                    </ul>
                    <h4>Mathematics</h4>
                    <ul class="menu" id="maths_tutorials">
                        <li><a  href="/add_and_subtract_fractions/index.htm" title="Add and Subtract Fractions">Add and Subtract Fractions</a></li>
                        <li><a  href="/add_and_subtract_whole_numbers/index.htm" title="Add and Subtract Whole Numbers">Add and Subtract Whole Numbers</a></li>
                        <li><a  href="/adding_and_subtracting_decimals/index.htm" title="Add and Subtract Decimal Numbers">Add and Subtract Decimal Numbers</a></li>
                        <li><a  href="/add_and_subtract_whole_numbers/index.htm" title="Add and Subtract Whole Numbers">Add and Subtract Whole Numbers</a></li>
                        <li><a  href="/adding_and_subtracting_decimals/index.htm" title="Add and Subtract Decimal Numbers">Add and Subtract Decimal Numbers</a></li>                            
                    </ul>
                    <h4>Academic</h4>
                        <ul class="menu" id="academic_tutorials">
                        <li><a  href="/cbse_syllabus/index.htm" title="CBSE Syllabus">CBSE Syllabus</a></li>
                        <li><a  href="/accounting_basics/index.htm" title="Learn Accounting Basics">Learn Accounting Basics</a></li>
                        <li><a  href="/adaptive_software_development/index.htm" title="Adaptive Software Development">Adaptive Software Development</a></li>
                        <li><a  href="/agile/index.htm" title="Learn Agile Methodology">Learn Agile Methodology</a></li>
                        <li><a  href="/agile/index.htm" title="Learn Agile Methodology">Learn Agile Methodology</a></li>
                    </ul>
                    <h4>Software Quality</h4>
                    <ul class="menu" id="software_quality">
                        <li><a  href="/agile_testing/index.htm" title="Learn Agile Testing">Learn Agile Testing</a></li>
                        <li><a  href="/cmmi/index.htm" title="Learn SEI CMMI">Learn SEI CMMI</a></li>
                        <li><a  href="/computer_security/index.htm" title="Learn Computer Security">Learn Computer Security</a></li>
                        <li><a  href="/concordion/index.htm" title="Learn Concordion">Learn Concordion</a></li>
                        <li><a  href="/continuous_integration/index.htm" title="Learn Continuous Integration">Learn Continuous Integration</a></li>
                    </ul>
                    <h4>Software Quality</h4>
                    <ul class="menu" id="software_quality">
                        <li><a  href="/agile_testing/index.htm" title="Learn Agile Testing">Learn Agile Testing</a></li>
                        <li><a  href="/cmmi/index.htm" title="Learn SEI CMMI">Learn SEI CMMI</a></li>
                        <li><a  href="/computer_security/index.htm" title="Learn Computer Security">Learn Computer Security</a></li>
                        <li><a  href="/concordion/index.htm" title="Learn Concordion">Learn Concordion</a></li>
                        <li><a  href="/continuous_integration/index.htm" title="Learn Continuous Integration">Learn Continuous Integration</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="featured-box">
                    <h4>Scripts</h4>
                    <ul class="menu" id="scripts">
                        <li><a  href="/javascript/index.htm" title="Learn JavaScript">Learn JavaScript</a></li>
                        <li><a  href="/jquery/index.htm" title="jquery">Learn jQuery</a></li>
                        <li><a  href="/jqueryui/index.htm" title="jqueryUI">Learn jQueryUI</a></li>
                        <li><a  href="/lua/index.htm" title="Learn Lua">Learn Lua</a></li>
                        <li><a  href="/numpy/index.htm" title="Learn Numpy">Learn Numpy</a></li>
                    </ul>
                    <h4>Management</h4>
                    <ul class="menu" id="management">
                        <li><a  href="/appreciative_inquiry/index.htm" title="Learn Appreciative Inquiry">Learn Appreciative Inquiry</a></li>
                        <li><a  href="/advertisement_and_marketing_communications/index.htm" title="Learn Advertisement and Marketing Communications">Adv. and Mkt Communications</a></li>
                        <li><a  href="/aviation_management/index.htm" title="Learn Aviation Management">Learn Aviation Management</a></li>
                        <li><a  href="/bank_management/index.htm" title="Learn Bank Management">Learn Bank Management</a></li>
                        <li><a  href="/bank_management/index.htm" title="Learn Bank Management">Learn Bank Management</a></li>
                    </ul>
                    <h4>SAP</h4>
                    <ul class="menu" id="sap_tutorials">
                        <li><a  href="/sap_abap/index.htm" title="Learn SAP ABAP">Learn SAP ABAP</a></li>
                        <li><a  href="/sap_apo/index.htm" title="Learn SAP APO">Learn SAP APO</a></li>
                        <li><a  href="/sap_bex/index.htm" title="Learn SAP Bex">Learn SAP Bex</a></li>
                        <li><a  href="/sap_basis/index.htm" title="Learn SAP BASIS">Learn SAP BASIS</a></li>
                        <li><a  href="/sap_bods/index.htm" title="Learn SAP BODS">Learn SAP BODS</a></li>
                    </ul>
                    <h4>Soft Skills</h4>
                    <ul class="menu" id="soft_skill">
                        <li><a  href="/anger_management/index.htm" title="Learn Anger Management">Learn Anger Management</a></li>
                        <li><a  href="/assertiveness/index.htm" title="Learn Assertiveness">Learn Assertiveness</a></li>
                        <li><a  href="/attention_management/index.htm" title="Learn Attention Management">Learn Attention Management</a></li>
                        <li><a  href="/body_language/index.htm" title="Learn Body Language">Learn Body Language</a></li>
                        <li><a  href="/body_language/index.htm" title="Learn Body Language">Learn Body Language</a></li>
                    </ul>
                    <h4>Selected Reading</h4>
                    <ul class="menu" id="selected_reading">
                        <li><a  href="computer_glossary.htm">Computer Glossary</a></li>
                        <li><a  href="/developers_best_practices/index.htm">Developer's Best Practices</a></li>
                        <li><a  href="free_web_graphics.htm">Download Free Graphics</a></li>
                        <li><a  href="/effective_resume_writing.htm">Effective Resume Writing</a></li>
                        <li><a  href="computer_whoiswho.htm">Who is Who</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="container">
    <div class="row">
        <h1 class="thick-heading">Selected Reading</h1>
        <div class="selected-reading-boxes col-md-12">
            <div class="col-md-2">
                <div class="course-box">
                    <a href="developers_best_practices/index.htm" title="Developer's Best Practices">
                        <img src="/assets/client/theme/images/developers-best-practices-icon.jpg"  class="big-icon" alt="Developer's Best Practices"/>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="course-box">
                    <a href="effective_resume_writing.htm" title="Effective Resume Writing">
                        <img src="/assets/client/theme/images/effective-resume-writing-icon.jpg"  class="big-icon" alt="Effective Resume Writing"/>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="course-box">
                    <a href="computer_glossary.htm" title="Computer Glossary">
                        <img src="/assets/client/theme/images/computer-glossary-icon.jpg"  class="big-icon" alt="Computer Glossary"/>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="course-box">
                    <a href="computer_whoiswho.htm" title="Who is Who in Computer">
                        <img src="/assets/client/theme/images/who-is-who-icon.jpg" class="big-icon" alt="Who is Who in Computer"/>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="course-box">
                    <a href="questions_and_answers.htm" title="Technical Questions and Answers">
                        <img src="/assets/client/theme/images/questions_answers.jpg" class="big-icon" alt="Technical Questions and Answers"/>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="course-box">
                    <a href="multi_language_tutorials.htm" title="Multi-Lingual Tutorials">
                        <img src="/assets/client/theme/images/multilanguage_tutorials.jpg" class="big-icon" alt="Multi-Lingual Tutorials"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>-->
<div class="map-section">
    <section class="featured footer map">
        <div class="container">
            <div class="row">
                <h2><strong>What</strong> Experts Say</h2>
                <div class="row">
                    <div class="col-md-4">
                        <blockquote class="testimonial">
                            <p>This is a truly excellent collection of resources and highly recommended. They are succinct, to the point and well presented. Students will find them accessible, relevant and easily digestible.</p>
                        </blockquote>
                        <div class="testimonial-arrow-down"></div>
                        <div class="testimonial-author">
                            <div class="img-thumbnail img-thumbnail-small">
                                <img src="/assets/client/theme/images/gordon.jpg" alt="Mr Gordon Moore">
                            </div>
                            <p><strong>Mr. Gordon Moore</strong><span>Tutor - IT, Maths and Statistics, Keele University International Study Centre, UK</span></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <blockquote class="testimonial">
                            <p>It's amazing to have a website like tutorialspoint at zero price and providing the best self learning content. I always recommend my students to refer to tutorialspoint for their assignments.</p>
                        </blockquote>
                        <div class="testimonial-arrow-down"></div>
                        <div class="testimonial-author">
                            <div class="img-thumbnail img-thumbnail-small">
                                <img src="/assets/client/theme/images/jahangir.jpg" alt="Dr. Jahangir">
                            </div>
                            <p><strong>Dr. Jahangir Alam</strong><span>Assistant Professor, Aligarh Muslim University, Aligarh UP, India</span></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <blockquote class="testimonial">
                            <p>I began searching for quality instructional material to use in the classroom. The material found on the tutorialspoint website met all of the criteria. I now have quality material...</p>
                        </blockquote>
                        <div class="testimonial-arrow-down"></div>
                            <div class="testimonial-author">
                            <div class="img-thumbnail img-thumbnail-small">
                                <img src="/assets/client/theme/images/velma.jpg" alt="Velma Latson">
                            </div>
                            <p><strong>Velma Latson.</strong><span>Lecturer Computer Technology, Bowie State University, USA</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<br/>
<br/>
<br/>
@endsection