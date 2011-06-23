
<%@ page import="org.jobapplication.statistics.CompanyStats" %>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="layout" content="main" />
        <g:set var="entityName" value="${message(code: 'companyStats.label', default: 'CompanyStats')}" />
        <title><g:message code="default.list.label" args="[entityName]" /></title>
    </head>
    <body>
        <div class="nav">
            <span class="menuButton"><a class="home" href="${createLink(uri: '/')}"><g:message code="default.home.label"/></a></span>
            <span class="menuButton"><g:link class="create" action="create"><g:message code="default.new.label" args="[entityName]" /></g:link></span>
        </div>
        <div class="body">
            <h1><g:message code="default.list.label" args="[entityName]" /></h1>
            <g:if test="${flash.message}">
            <div class="message">${flash.message}</div>
            </g:if>
            <div class="list">
                <table>
                    <thead>
                        <tr>
                        
                            <g:sortableColumn property="id" title="${message(code: 'companyStats.id.label', default: 'Id')}" />
                        
                            <g:sortableColumn property="answer" title="${message(code: 'companyStats.answer.label', default: 'Answer')}" />
                        
                            <g:sortableColumn property="application" title="${message(code: 'companyStats.application.label', default: 'Application')}" />
                        
                            <g:sortableColumn property="interview" title="${message(code: 'companyStats.interview.label', default: 'Interview')}" />
                        
                            <g:sortableColumn property="responseTime" title="${message(code: 'companyStats.responseTime.label', default: 'Response Time')}" />
                        
                        </tr>
                    </thead>
                    <tbody>
                    <g:each in="${companyStatsInstanceList}" status="i" var="companyStatsInstance">
                        <tr class="${(i % 2) == 0 ? 'odd' : 'even'}">
                        
                            <td><g:link action="show" id="${companyStatsInstance.id}">${fieldValue(bean: companyStatsInstance, field: "id")}</g:link></td>
                        
                            <td>${fieldValue(bean: companyStatsInstance, field: "answer")}</td>
                        
                            <td>${fieldValue(bean: companyStatsInstance, field: "application")}</td>
                        
                            <td>${fieldValue(bean: companyStatsInstance, field: "interview")}</td>
                        
                            <td>${fieldValue(bean: companyStatsInstance, field: "responseTime")}</td>
                        
                        </tr>
                    </g:each>
                    </tbody>
                </table>
            </div>
            <div class="paginateButtons">
                <g:paginate total="${companyStatsInstanceTotal}" />
            </div>
        </div>
    </body>
</html>
