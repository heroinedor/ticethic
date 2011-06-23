package org.jobapplication.statistics

class CompanyStatsController {

    static allowedMethods = [save: "POST", update: "POST", delete: "POST"]

    def index = {
        redirect(action: "list", params: params)
    }

    def list = {
        params.max = Math.min(params.max ? params.int('max') : 10, 100)
        [companyStatsInstanceList: CompanyStats.list(params), companyStatsInstanceTotal: CompanyStats.count()]
    }

    def create = {
        def companyStatsInstance = new CompanyStats()
        companyStatsInstance.properties = params
        return [companyStatsInstance: companyStatsInstance]
    }

    def save = {
        def companyStatsInstance = new CompanyStats(params)
        if (companyStatsInstance.save(flush: true)) {
            flash.message = "${message(code: 'default.created.message', args: [message(code: 'companyStats.label', default: 'CompanyStats'), companyStatsInstance.id])}"
            redirect(action: "show", id: companyStatsInstance.id)
        }
        else {
            render(view: "create", model: [companyStatsInstance: companyStatsInstance])
        }
    }

    def show = {
        def companyStatsInstance = CompanyStats.get(params.id)
        if (!companyStatsInstance) {
            flash.message = "${message(code: 'default.not.found.message', args: [message(code: 'companyStats.label', default: 'CompanyStats'), params.id])}"
            redirect(action: "list")
        }
        else {
            [companyStatsInstance: companyStatsInstance]
        }
    }

    def edit = {
        def companyStatsInstance = CompanyStats.get(params.id)
        if (!companyStatsInstance) {
            flash.message = "${message(code: 'default.not.found.message', args: [message(code: 'companyStats.label', default: 'CompanyStats'), params.id])}"
            redirect(action: "list")
        }
        else {
            return [companyStatsInstance: companyStatsInstance]
        }
    }

    def update = {
        def companyStatsInstance = CompanyStats.get(params.id)
        if (companyStatsInstance) {
            if (params.version) {
                def version = params.version.toLong()
                if (companyStatsInstance.version > version) {
                    
                    companyStatsInstance.errors.rejectValue("version", "default.optimistic.locking.failure", [message(code: 'companyStats.label', default: 'CompanyStats')] as Object[], "Another user has updated this CompanyStats while you were editing")
                    render(view: "edit", model: [companyStatsInstance: companyStatsInstance])
                    return
                }
            }
            companyStatsInstance.properties = params
            if (!companyStatsInstance.hasErrors() && companyStatsInstance.save(flush: true)) {
                flash.message = "${message(code: 'default.updated.message', args: [message(code: 'companyStats.label', default: 'CompanyStats'), companyStatsInstance.id])}"
                redirect(action: "show", id: companyStatsInstance.id)
            }
            else {
                render(view: "edit", model: [companyStatsInstance: companyStatsInstance])
            }
        }
        else {
            flash.message = "${message(code: 'default.not.found.message', args: [message(code: 'companyStats.label', default: 'CompanyStats'), params.id])}"
            redirect(action: "list")
        }
    }

    def delete = {
        def companyStatsInstance = CompanyStats.get(params.id)
        if (companyStatsInstance) {
            try {
                companyStatsInstance.delete(flush: true)
                flash.message = "${message(code: 'default.deleted.message', args: [message(code: 'companyStats.label', default: 'CompanyStats'), params.id])}"
                redirect(action: "list")
            }
            catch (org.springframework.dao.DataIntegrityViolationException e) {
                flash.message = "${message(code: 'default.not.deleted.message', args: [message(code: 'companyStats.label', default: 'CompanyStats'), params.id])}"
                redirect(action: "show", id: params.id)
            }
        }
        else {
            flash.message = "${message(code: 'default.not.found.message', args: [message(code: 'companyStats.label', default: 'CompanyStats'), params.id])}"
            redirect(action: "list")
        }
    }
}
