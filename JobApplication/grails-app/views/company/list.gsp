
<%@ page import="org.jobapplication.company.Company" %>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="layout" content="main" />
        <g:set var="entityName" value="${message(code: 'company.label', default: 'Company')}" />
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
                        
                            <g:sortableColumn property="id" title="${message(code: 'company.id.label', default: 'Id')}" />
                        
                            <g:sortableColumn property="name" title="${message(code: 'company.name.label', default: 'Name')}" />
                        
                            <g:sortableColumn property="address" title="${message(code: 'company.address.label', default: 'Address')}" />
                        
                            <g:sortableColumn property="POBox" title="${message(code: 'company.POBox.label', default: 'POB ox')}" />
                        
                            <g:sortableColumn property="postalCode" title="${message(code: 'company.postalCode.label', default: 'Postal Code')}" />
                        
                            <g:sortableColumn property="town" title="${message(code: 'company.town.label', default: 'Town')}" />
                        
                        </tr>
                    </thead>
                    <tbody>
                    <g:each in="${companyInstanceList}" status="i" var="companyInstance">
                        <tr class="${(i % 2) == 0 ? 'odd' : 'even'}">
                        
                            <td><g:link action="show" id="${companyInstance.id}">${fieldValue(bean: companyInstance, field: "id")}</g:link></td>
                        
                            <td>${fieldValue(bean: companyInstance, field: "name")}</td>
                        
                            <td>${fieldValue(bean: companyInstance, field: "address")}</td>
                        
                            <td>${fieldValue(bean: companyInstance, field: "POBox")}</td>
                        
                            <td>${fieldValue(bean: companyInstance, field: "postalCode")}</td>
                        
                            <td>${fieldValue(bean: companyInstance, field: "town")}</td>
                        
                        </tr>
                    </g:each>
                    </tbody>
                </table>
            </div>
            <div class="paginateButtons">
                <g:paginate total="${companyInstanceTotal}" />
            </div>
        </div>
    </body>
</html>
