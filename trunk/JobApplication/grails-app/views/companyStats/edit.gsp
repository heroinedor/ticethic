

<%@ page import="org.jobapplication.statistics.CompanyStats" %>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="layout" content="main" />
        <g:set var="entityName" value="${message(code: 'companyStats.label', default: 'CompanyStats')}" />
        <title><g:message code="default.edit.label" args="[entityName]" /></title>
    </head>
    <body>
        <div class="nav">
            <span class="menuButton"><a class="home" href="${createLink(uri: '/')}"><g:message code="default.home.label"/></a></span>
            <span class="menuButton"><g:link class="list" action="list"><g:message code="default.list.label" args="[entityName]" /></g:link></span>
            <span class="menuButton"><g:link class="create" action="create"><g:message code="default.new.label" args="[entityName]" /></g:link></span>
        </div>
        <div class="body">
            <h1><g:message code="default.edit.label" args="[entityName]" /></h1>
            <g:if test="${flash.message}">
            <div class="message">${flash.message}</div>
            </g:if>
            <g:hasErrors bean="${companyStatsInstance}">
            <div class="errors">
                <g:renderErrors bean="${companyStatsInstance}" as="list" />
            </div>
            </g:hasErrors>
            <g:form method="post" >
                <g:hiddenField name="id" value="${companyStatsInstance?.id}" />
                <g:hiddenField name="version" value="${companyStatsInstance?.version}" />
                <div class="dialog">
                    <table>
                        <tbody>
                        
                            <tr class="prop">
                                <td valign="top" class="name">
                                  <label for="answer"><g:message code="companyStats.answer.label" default="Answer" /></label>
                                </td>
                                <td valign="top" class="value ${hasErrors(bean: companyStatsInstance, field: 'answer', 'errors')}">
                                    <g:textField name="answer" value="${companyStatsInstance?.answer}" />
                                </td>
                            </tr>
                        
                            <tr class="prop">
                                <td valign="top" class="name">
                                  <label for="application"><g:message code="companyStats.application.label" default="Application" /></label>
                                </td>
                                <td valign="top" class="value ${hasErrors(bean: companyStatsInstance, field: 'application', 'errors')}">
                                    <g:textField name="application" value="${companyStatsInstance?.application}" />
                                </td>
                            </tr>
                        
                            <tr class="prop">
                                <td valign="top" class="name">
                                  <label for="interview"><g:message code="companyStats.interview.label" default="Interview" /></label>
                                </td>
                                <td valign="top" class="value ${hasErrors(bean: companyStatsInstance, field: 'interview', 'errors')}">
                                    <g:textField name="interview" value="${companyStatsInstance?.interview}" />
                                </td>
                            </tr>
                        
                            <tr class="prop">
                                <td valign="top" class="name">
                                  <label for="responseTime"><g:message code="companyStats.responseTime.label" default="Response Time" /></label>
                                </td>
                                <td valign="top" class="value ${hasErrors(bean: companyStatsInstance, field: 'responseTime', 'errors')}">
                                    <g:textField name="responseTime" value="${companyStatsInstance?.responseTime}" />
                                </td>
                            </tr>
                        
                        </tbody>
                    </table>
                </div>
                <div class="buttons">
                    <span class="button"><g:actionSubmit class="save" action="update" value="${message(code: 'default.button.update.label', default: 'Update')}" /></span>
                    <span class="button"><g:actionSubmit class="delete" action="delete" value="${message(code: 'default.button.delete.label', default: 'Delete')}" onclick="return confirm('${message(code: 'default.button.delete.confirm.message', default: 'Are you sure?')}');" /></span>
                </div>
            </g:form>
        </div>
    </body>
</html>
