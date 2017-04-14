@extends('layouts.client')

@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-3">
                <aside class="sidebar">
                    <ul class="nav nav-list primary left-menu">
                            <li class="heading">Ant Tutorial</li>
                            <li><a target="_top" href="/ant/index.htm" style="background-color: rgb(214, 214, 214);">Ant - Home</a></li>
                            <li><a target="_top" href="/ant/ant_introduction.htm">Ant - Introduction</a></li>
                            <li><a target="_top" href="/ant/ant_environment.htm">Ant - Environment Setup</a></li>
                            <li><a target="_top" href="/ant/ant_build_files.htm">Ant - Build Files</a></li>
                            <li><a target="_top" href="/ant/ant_property_task.htm">Ant - Property Task</a></li>
                            <li><a target="_top" href="/ant/ant_property_files.htm">Ant - Property Files</a></li>
                            <li><a target="_top" href="/ant/ant_data_types.htm">Ant - Data Types</a></li>
                            <li><a target="_top" href="/ant/ant_build_project.htm">Ant - Building Projects</a></li>
                            <li><a target="_top" href="/ant/ant_build_documentation.htm">Ant - Build Documentation</a></li>
                            <li><a target="_top" href="/ant/ant_creating_jar_files.htm">Ant - Creating JAR files</a></li>
                            <li><a target="_top" href="/ant/ant_creating_war_files.htm">Ant - Creating WAR files</a></li>
                            <li><a target="_top" href="/ant/ant_packaging_applications.htm">Ant - Packaging Applications</a></li>
                            <li><a target="_top" href="/ant/ant_deploying_applications.htm">Ant - Deploying Applications</a></li>
                            <li><a target="_top" href="/ant/ant_executing_java_code.htm">Ant - Executing Java code</a></li>
                            <li><a target="_top" href="/ant/ant_eclipse_integration.htm">Ant - Eclipse Integration</a></li>
                            <li><a target="_top" href="/ant/ant_junit_integration.htm">Ant - Junit Integration</a></li>
                            <li><a target="_top" href="/ant/ant_extending_ant.htm">Ant - Extending Ant</a></li>
                            </ul>
                            <ul class="nav nav-list primary left-menu">
                            <li class="heading">Ant Useful Resources</li>
                            <li><a target="_top" href="/ant/ant_quick_guide.htm">Ant - Quick Guide</a></li>
                            <li><a target="_top" href="/ant/ant_useful_resources.htm">Ant - Useful Resources</a></li>
                            <li><a target="_top" href="/ant/ant_discussion.htm">Ant - Discussion</a></li>
                            </ul>
                            <ul class="nav nav-list primary push-bottom left-menu special">
                            <li class="sreading">Selected Reading</li>
                            <li><a target="_top" href="/developers_best_practices/index.htm">Developer's Best Practices</a></li>
                            <li><a target="_top" href="/questions_and_answers.htm">Questions and Answers</a></li>
                            <li><a target="_top" href="/effective_resume_writing.htm">Effective Resume Writing</a></li>
                            <li><a target="_top" href="/hr_interview_questions/index.htm">HR Interview Questions</a></li>
                            <li><a target="_top" href="/computer_glossary.htm">Computer Glossary</a></li>
                            <li><a target="_top" href="/computer_whoiswho.htm">Who is Who</a></li>
                    </ul>
                </aside>
            </div>
            <!-- PRINTING STARTS HERE -->
            <div class="col-md-9">               
                <div class="detail">
                    <div class="middle-col">
                        <div class="pre-btn">
                            <a href="/index.htm"><i class="icon icon-arrow-circle-o-left big-font"></i> Previous Page</a>
                        </div>
                        <div class="nxt-btn">
                            <a href="/ant/ant_introduction.htm">Next Page <i class="icon icon-arrow-circle-o-right big-font"></i>&nbsp;</a>
                        </div>
                        <hr>
                        <div class="clearer"></div>
                        <div class="shares">
                            <img src="/assets/client/theme/images/icon/like.png">
                            <a href="javascript:void(0)">
                                <img src="/assets/client/theme/images/facebook_icon.jpg" alt="img">
                            </a>
                            <a href="javascript:void(0)">
                                <img src="/assets/client/theme/images/twitter_icon.jpg" alt="img">
                            </a>
                            <a href="javascript:void(0)">
                            <img src="/assets/client/theme/images/linkedin_icon.jpg" alt="img">
                            </a>
                            <a href="javascript:void(0)">
                                <img src="/assets/client/theme/images/googleplus_icon.jpg" alt="img">
                            </a>
                        </div>                        
                        <h1>Apache Ant Tutorial</h1>                        
                        <div>
                        <p>Apache Ant is a Java based build tool from Apache Software Foundation. Apache Ant's build files are written in XML and they take advantage of being open standard, portable and easy to understand.</p>
                        <p>This tutorial should show you how to use Apache ANT to automate the build and deployment process in simple and easy steps. After completing this tutorial, you should find yourself at a moderate level of expertise in using Apache Ant from where you may take yourself to next levels.</p>
                        </div>
                        <h1>Audience</h1>
                        <p>This tutorial has been prepared for the beginners to help them understand the basic functionality of Apache ANT to automate the build and deployment process.</p>
                        <h1>Prerequisites</h1>
                        <p>For this tutorial, it is assumed that the readers have prior knowledge of basic software development using java or any other programming language. This should help if you had some exposure to the software build and deployment process.</p>
                        <hr>
                        <div class="col-md-12">
                            <div class="pre-btn col-md-3">
                                <a href="/index.htm"><i class="icon icon-arrow-circle-o-left big-font"></i> Previous Page</a>
                            </div>
                            <div class="print-btn col-md-3">
                                <a href="/cgi-bin/printpage.cgi" target="_blank"><i class="icon icon-print big-font"></i> Print</a>
                            </div>
                            <div class="pdf-btn col-md-3">
                                <a href="/ant/pdf/index.pdf" title="Apache Ant Tutorial" target="_blank"><i class="icon icon-file-pdf-o big-font"></i> PDF</a>
                            </div>
                            <div class="nxt-btn col-md-3">
                                <a href="/ant/ant_introduction.htm">Next Page <i class="icon icon-arrow-circle-o-right big-font"></i>&nbsp;</a>
                            </div>                           
                        </div>                        
                        <hr>
                        
                        <!--Comment-->
                        <div class="wp-comment col-md-12">
                            <h3>Comment</h3>
                            <div class="comments">
                                <div class="media comment me">
                                    <div class="media-left media-middle">
                                        <a href="#"><img class="media-object bd-radius w-40-40" src="/assets/client/theme/images/no-avatar.png" alt=""></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            Vu FB<span><time class="timeago" datetime="2017-04-04T15:38:24+09:00">1 hour ago</time></span>
                                        </h4>
                                        <span class="more">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</span>
                                    </div>
                                    <a class="delete">X</a>                           
                                </div>
                                <div class="media comment">
                                    <div class="media-left media-middle">
                                        <a href="#"><img class="media-object bd-radius avatar-40-40" src="/assets/client/theme/images/no-avatar.png" alt=""></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            Vu FB<span><time class="timeago" datetime="2017-04-04T15:38:24+09:00">1 hour ago</time></span>
                                        </h4>
                                        <span class="more">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</span>
                                    </div>
                                </div>
                                <div class="loading"></div>
                            </div>
                            <div class="media comment-sub">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object bd-radius avatar-40-40" src="/assets/client/theme/images/no-avatar.png" alt="">
                                    </a>
                                </div>
                                <div class="comment-box">
                                    <textarea rows="4" name="content" cols="50" placeholder="Enter comments here"></textarea>
                                    <div class="caret-m"></div>
                                </div>
                            </div>
                        </div>
                        <!--End Comment-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection